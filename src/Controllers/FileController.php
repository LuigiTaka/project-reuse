<?php

namespace ProjectReuse\Controllers;
use ProjectReuse\Controllers\BaseController;
use ProjectReuse\HTTPUtils;

/**
* Presume que cada nomde de arquivo será único dentro do diretório.
*
**/
class FileController extends BaseController
{
	private $rootPath;
	
	protected $fileId = '';
	protected $folder = '';

	function __construct(string $requestMethod,?string $folder,?string $fileId)
	{
		$this->requestMethod = $requestMethod; 
		$this->fileId = $fileId;
		$this->folder = $folder;

		//@todo Essa informação vem de um arquivo de configuração.
		//		deve ser configurável para a reutilização em qualquer lugar.
		$this->rootPath = __DIR__."/../../data/";
	}



	function processRequest()
	{ 

		switch( $this->requestMethod ){ 
			case 'GET':
				$response = $this->getFile();
				break;	
			case 'POST':
				//cria
				$response = $this->createFileFromRequest();
				break;
			case 'PUT':
				$response = $this->updateFileFromRequest();
				//update
				break;
			case 'DELETE':	
				//remove
				break;
			default:
				break;
		}
		$header = $this->getDefaultHeaders();
		$header[] = $response->getStatusCode();
		$this->setHeader( $header );
		$this->flushHeaders();
		echo $response->getBody();
		
	}

	protected function getRequestFilepath()
	{ 
		$filepath = $this->rootPath.$this->folder;
		if(!is_dir($filepath)){ 
			throw new \Exception("Diretório não existe.");
		}
		$filepath = $filepath."/".$this->fileId;
		$files = glob("$filepath.*");
		$count = count($files);

		if(!$count){ 
			throw new \Exception("Arquivo não existe.");
		}

		if($count > 1){ 
			throw new \Exception("Mais de um arquivo.");
		}
	
		return $files[0];
	}

	protected function createFileFromRequest()
	{ 
		HTTPUtils::getPost($_POST);
		$content = $_POST['content'];
		$extension = $_POST['extension']??'.txt';
		$folder = $_POST['folder'];
		$id = $this->getFileId();

		$path = $this->rootPath.$folder;
		if(!is_dir($path)){ 
			return $this->notFoundResponse();
		}
		$path .= "/".$id."$extension";
		file_put_contents($path,$content);
		return $this->jsonResponse([
			'response' => ['id' => $id,'folder' => $folder ]
			] 
		,200);
	
	}


	protected function updateFileFromRequest()
	{ 
		HTTPUtils::getPost($_POST);
		$content = $_POST['content'];

		$folder = $this->folder;
		$fileId = $this->fileId;
		try{ 
			$filepath = $this->getRequestFilepath();
		}catch(\Throwable $e){ 
			return $this->jsonResponse([
				'error' => $e->getMessage(),
			],404);
		}
		file_put_contents( $filepath,$content );
		return $this->jsonResponse(['response' => "Arquivo modificado."],200);
	}

	private function getFileId()
	{ 
		return uniqid("file-");
	}
	
	protected function getFile()
	{ 

		try{ 
			$filepath = $this->getRequestFilepath();
		
		}catch(\Throwable $e){ 
			return $this->jsonResponse([ 
				'error' => $e->getMessage(),
			], 404 );
		}
		$content = file_get_contents($filepath);
		$data = [ 
			'response' => [ 
				'content' => $content,
			]
		];

		return $this->jsonResponse( $data, 200 );
	}
	
}
