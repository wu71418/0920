<html>
    <head>
        <meta charst='utf-8'>
    </head>
    <body>
        <form method="post" action="">
            <input type="submit" name="button" value="送出">
    </body>

<?php
    session_start();

    if(isset($_POST['button'])){
        $array_rnd=random_numbers();
        save_num($array_rnd,$_SESSION['array_save']);
    }

    if(!isset($_SESSION['array_save']))
        $_SESSION['array_save']=array();

    function random_numbers(){
        $array_rnd=array();
        for($i=0;$i<3;$i++)
            $array_rnd[$i]=rand(0,9);

        $array_rnd=array_unique($array_rnd);

        if(count($array_rnd)!=3)
        {
            for($i=count($array_rnd);$i<=3;$i++)
            {
                if($array_rnd[$i]!=null)
                {
                    $array_rnd=array_unique($array_rnd);
                }
                else
                {
                    $array_rnd[$i]=rand(0,9);
                    $i=0;
                }
            }
        }
        
        if(count($array_rnd)==4)
            unset($array_rnd[3]);

        print_r($array_rnd);
        return $array_rnd;
    }

    function save_num($array_rnd, &$array_save) {
        $array_save[] = $array_rnd;

        if(count($array_save)>10){
            session_unset();
        }
    }
    

    echo "<br>";
    print_r($_SESSION['array_save']);

?>
</html>