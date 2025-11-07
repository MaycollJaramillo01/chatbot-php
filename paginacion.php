<?php
  include 'conex.php';

  $query=mysqli_query($con,"select count(id) from reviews");
  $row = mysqli_fetch_row($query);

  $rows = $row[0];
  $page_rows = 2;
  $last = ceil($rows/$page_rows);

  if($last < 1) {$last = 1;}
  $pagenum = 1;

  if(isset($_GET['pn'])){$pagenum = preg_replace('#[^0-9]#','', $_GET['pn']); }

  if ($pagenum < 1) { $pagenum = 1; } else if ($pagenum < $last) {$pagenum = $last; }

  $limit = 'LIMIT ' .($pagenum - 1) * $page_rows .','.$page_rows;
  
  $nquery=mysqli_query($con,"select * from reviews".$limit);

  $paginationCtrls = '';

  if($last != 1)
  {
    if ($pagenum > 1) 
    {
      $previous = $pagenum - 1;
      $paginationCtrls .= '<a class="btn btn-primary" href="'.$_SERVER['PHP_SELF'].'?pn='.$previous.'"> Anterior</a>';

      for($i = $pagenum-4; $i < $pagenum; $i++)
      {
        if($i > 0)
        {
          $paginationCtrls .= '<a class="btn btn-success" href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'">'.$i.'</a>';
        }
      }
    }

    //$paginationCtrls .= '/'.$pagenum;

    for($i = $pagenum+1; $i <= $last; $i++)
    {
      $paginationCtrls .= '<a class="btn btn-default" href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'">'.$i.'</a>';
      if($i <= $pagenum+4){break; }
    }

    if ($pagenum != $last) 
    {
      $next = $pagenum + 1;
      $paginationCtrls .= ' <a class="btn btn-danger" href="'.$_SERVER['PHP_SELF'].'?pn='.$next.'"> Siguiente</a>';
    }
  }

?>