<?php

function chkWin($RecBreakdraw,$ballNum,$luckyStar){

    $allWinCase1 = 0;
    $allWinCase2 = 0;
    $allWinCase3 = 0;
    $allWinCase4 = 0;
    $allWinCase5 = 0;
    $allWinCase6 = 0;
    $allWinCase8 = 0;
    $allWinCase9 = 0;
    $allWinCase10 = 0;
    $allWinCase11 = 0;
    $allWinCase12 = 0;
    $allWinCase13 = 0;

    foreach ($RecBreakdraw as $key => $val) {  

        $countBall = 0;
        $countLucky = 0;
        
        $chkballNum = explode('-',$val['ball_numbers']);
        $chkLucky = explode('-',$val['lucky_stars']);
        
        foreach ($chkballNum as $keyBall => $valBall) { 
            if(in_array($valBall, $ballNum)){
                $countBall = $countBall+1;
            }
        }

        foreach ($chkLucky as $keyLuck => $valLuck) { 
            if(in_array($valLuck, $luckyStar)){
                $countLucky = $countLucky+1;
            }
        }

        if($countBall == 5 && $countLucky == 2){
            // case 5 + 2 stars 
            $allWinCase1 = $allWinCase1+1;
        }else if($countBall == 5 && $countLucky == 1){
            // case 5 + 1 stars 
            $allWinCase2 = $allWinCase2+1;
        }else if($countBall == 5 && $countLucky == 0){
            // case 5
            $allWinCase3 = $allWinCase3+1;
        }else if($countBall == 4 && $countLucky == 2){
            // case 4 + 2 stars     
            $allWinCase4 = $allWinCase4+1;
        }else if($countBall == 4 && $countLucky == 1){
            // case 4 + 1 stars     
            $allWinCase5 = $allWinCase5+1;
        }else if($countBall == 4 && $countLucky == 0){
            // case 4  
            $allWinCase6 = $allWinCase6+1;
        }else if($countBall == 3 && $countLucky == 2){
            // case 3 + 2 stars     
            $allWinCase7 = $allWinCase7+1;
        }else if($countBall == 3 && $countLucky == 1){
            // case 3 + 1 stars 
            $allWinCase8 = $allWinCase8+1;    
        }else if($countBall == 3 && $countLucky == 0){
            // case 3
            $allWinCase9 = $allWinCase9+1;
        }else if($countBall == 2 && $countLucky == 2){
            // case 2 + 2 stars   
            $allWinCase10 = $allWinCase10+1;  
        }else if($countBall == 2 && $countLucky == 1){
            // case 2 + 1 stars   
            $allWinCase11 = $allWinCase11+1;  
        }else if($countBall == 2 && $countLucky == 0){
            // case 2
            $allWinCase12 = $allWinCase12+1;
        }else if($countBall == 1 && $countLucky == 2){
            // case 1 + 1 stars     
            $allWinCase13 = $allWinCase13+1;
        }

    }

    $winList = [$allWinCase1,$allWinCase2,$allWinCase3,$allWinCase4,$allWinCase5,$allWinCase6,$allWinCase7,$allWinCase8,$allWinCase9,$allWinCase10,$allWinCase11,$allWinCase12,$allWinCase13];

    return $winList;
    
}

function chkWinLotorry($db,$dateC,$betresults){

    $allWinCase1 = 0;
    $allWinCase2 = 0;
    $allWinCase3 = 0;
    $allWinCase4 = 0;
    $allWinCase5 = 0;
    $allWinCase6 = 0;
    $allWinCase8 = 0;
    $allWinCase9 = 0;
    $allWinCase10 = 0;
    $allWinCase11 = 0;
    $allWinCase12 = 0;
    $allWinCase13 = 0;
    $allWinCase14 = 0;
    $allWinCase15 = 0;

    if($betresults){

        $RecBreakdrawP = $db->select("SELECT * FROM bet_lotorry_play WHERE around = '".$dateC."'");
    
        foreach ($RecBreakdrawP as $key => $vals) {
    
            set_time_limit(0);
            $RecPlayRes = $db->select("SELECT * FROM bet_lotorry_play_results WHERE id = '".$vals['id']."'");
            $countMatch = 0;
            foreach ($RecPlayRes as $key2 => $vals2) {
                set_time_limit(0);
                if($vals2['results'] == $betresults[$key2]){
                    $countMatch = $countMatch+1;
                }           
            }

            switch ($countMatch) {
                case 15:
                    $allWinCase1 = $allWinCase1+1;
                    break;
                case 14:
                    $allWinCase2 = $allWinCase2+1;
                    break;
                case 13:
                    $allWinCase3 = $allWinCase3+1;
                    break;
                case 13:
                    $allWinCase3 = $allWinCase3+1;
                    break;
                case 12:
                    $allWinCase4 = $allWinCase4+1;
                    break;
                case 11:
                    $allWinCase5 = $allWinCase5+1;
                    break;
                case 10:
                    $allWinCase6 = $allWinCase6+1;
                    break;
                case 9:
                    $allWinCase7 = $allWinCase7+1;
                    break;
                case 8:
                    $allWinCase8 = $allWinCase8+1;
                    break;
                case 7:
                    $allWinCase9 = $allWinCase9+1;
                    break;
                case 6:
                    $allWinCase10 = $allWinCase10+1;
                    break;
                case 5:
                    $allWinCase11 = $allWinCase11+1;
                    break;
                case 4:
                    $allWinCase12 = $allWinCase12+1;
                    break;
                case 3:
                    $allWinCase13 = $allWinCase13+1;
                    break;
                case 2:
                    $allWinCase14 = $allWinCase14+1;
                    break;
                case 1:
                    $allWinCase15 = $allWinCase15+1;
                    break;
            }
        }

        $winList = [$allWinCase1,$allWinCase2,$allWinCase3,$allWinCase4,$allWinCase5,$allWinCase6,$allWinCase7,$allWinCase8,$allWinCase9,$allWinCase10,$allWinCase11,$allWinCase12,$allWinCase13,$allWinCase14,$allWinCase15];
        return $winList;

    }else{
        $winList = [$allWinCase1,$allWinCase2,$allWinCase3,$allWinCase4,$allWinCase5,$allWinCase6,$allWinCase7,$allWinCase8,$allWinCase9,$allWinCase10,$allWinCase11,$allWinCase12,$allWinCase13,$allWinCase14,$allWinCase15];
        return $winList;
    }

}

?>