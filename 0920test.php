<html>
    <head>
        <meta charst='utf-8'>
    </head>
    <body>
        <form method="post" action="">
            <button name='clean' >清除</button>
            <input type="submit" name="button" value="送出">
    </body>

<?php
    session_start();

    if (!isset($_SESSION['btn_count'])) 
        $_SESSION['btn_count'] = 0;

    if(!isset($_SESSION['array_save']))
        $_SESSION['array_save']=array();

    if(isset($_POST['button']))
    {
        $array_rnd=random_numbers();
        save_num($array_rnd,$_SESSION['array_save']);
        if($_SESSION['btn_count']<9)
            $_SESSION['btn_count']=$_SESSION['btn_count']+1;
        else
        {
            require_once 'db.php';
            session_unset();
        }
    }

    if(isset($_POST['clean']))
        session_unset();

    function random_numbers()
    {
        $array_rnd=array();

        for($i=0;$i<3;$i++)
            $array_rnd[$i]=rand(0,9);

        $array_rnd=array_unique($array_rnd);

        if(count($array_rnd)!=3)
        {
            for($i=count($array_rnd);$i<=3;$i++)
            {
                if(isset($array_rnd[$i]) && $array_rnd[$i] != null)
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
        if (isset($array_rnd[1])) {
            if (abs($array_rnd[1] - $array_rnd[0]) == abs($array_rnd[2] - $array_rnd[1])) {
                echo "成功！總共使用了" . $_SESSION['btn_count'] . "次";
                require_once 'db.php';
                }
        
        }      return $array_rnd;
    }

    function save_num($array_rnd, &$array_save) {
        $array_save[] = $array_rnd;
        print_r($_SESSION['array_save']);

        if(count($array_save)>10){
            session_unset();
        }
    }

    echo "<br>";
?>
</html>