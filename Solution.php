<?php
/**
 * Don't let the machines win. You are humanity's last hope...
 **/

 /*
 *  https://www.codingame.com/ide/puzzle/there-is-no-spoon-episode-1
 *  Solution By Luis Trista
 * */

// $width: the number of cells on the X axis
fscanf(STDIN, "%d", $width);
// $height: the number of cells on the Y axis
fscanf(STDIN, "%d", $height);
$matrix = array();

for ($i = 0; $i < $height; $i++)
{
    $matrix[] = str_split(stream_get_line(STDIN, 31 + 1, "\n"));
}

// Creating "defense" object
$defense = new defense($matrix, $width, $height);
$defense->shootWeapons();

class defense{
    private $matrix;
    private $width;
    private $height;

    function __construct($matrix, $width, $height){
        $this->matrix = $matrix;
        $this->width = $width;
        $this->height = $height;
    }

    private function getRight($node){
        if($this->isValidNode($node[0]+1, $node[1])){
            return [$node[0]+1,$node[1]];
        }else{
            for($scan = $node[0]+2; $scan < $this->width; $scan++){
                if($this->isValidNode($scan, $node[1])){
                    return [$scan,$node[1]];
                }
            }
            return [-1,-1];
        }
    }

    private function getBottom($node){
        if($this->isValidNode($node[0], $node[1]+1)){
            return [$node[0], $node[1]+1];
        }else{
            for($scan = $node[1]+2; $scan < $this->height; $scan++){
                if($this->isValidNode($node[0], $scan)){
                    return [$node[0], $scan];
                }
            }
            return [-1,-1];
        }
    }

    private function isValidNode($column, $line){
        if(isset($this->matrix[$line][$column]) && $this->matrix[$line][$column] == '0'){
            return true;
        }else{
            return false;
        }
    }

    public function shootWeapons(){
        // moving in bidimensional matrix
        for($line = 0; $line < $this->height; $line++){
            for($column = 0; $column < $this->width; $column++ ){
                // has the xy position in matrix the value 0 ?
                if($this->isValidNode($column, $line)){
                    $node = [$column, $line];

                    // get closest right node
                    $rightNode = $this->getRight($node);

                    //get closest bottom node
                    $bottomNode = $this->getBottom($node);

                    // printing the result
                    echo $column.' '.$line.' '.$rightNode[0].' '.$rightNode[1].' '.$bottomNode[0].' '.$bottomNode[1]."\n";
                }
            }
        }
        
    } 
}

?>