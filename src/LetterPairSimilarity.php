<?php
namespace TracaReuse;

class LetterPairSimilarity
{
    /**
     * @param $str
     * @return mixed
     */
    private function wordLetterPairs($str)
    {
        $allPairs = array();

        // Tokeniza a string e põe os tokens/palavras num array

        $words = explode(' ', $str);


        for ($w = 0; $w < count($words); $w++) {
            // acha os pares
            $pairsInWord = $this->letterPairs($words[$w]);

            for ($p = 0; $p < count($pairsInWord); $p++) {
                $allPairs[] = $pairsInWord[$p];
            }
        }

        return $allPairs;
    }

    /**
     * @param $str
     * @return array
     */
    private function letterPairs($str)
    {
        $numPairs = mb_strlen($str) - 1;
        $pairs = array();

        for ($i = 0; $i < $numPairs; $i++) {
            $pairs[$i] = mb_substr($str, $i, 2);
        }

        return $pairs;
    }

    /**
     * @param $str1
     * @param $str2
     * @return float
     */
    public function compareStrings($str1, $str2)
    {
        $pairs1 = $this->wordLetterPairs(strtoupper($str1));
        $pairs2 = $this->wordLetterPairs(strtoupper($str2));

        $intersection = 0;

        $union = count($pairs1) + count($pairs2);

        for ($i = 0; $i < count($pairs1); $i++) {
            $pair1 = $pairs1[$i];

            $pairs2 = array_values($pairs2);
            for ($j = 0; $j < count($pairs2); $j++) {
                $pair2 = $pairs2[$j];
                if ($pair1 === $pair2) {
                    $intersection++;
                    unset($pairs2[$j]);
                    break;
                }
            }
        }

        return (2.0 * $intersection) / $union;
    }
}
