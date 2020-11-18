<?php

include 'db.php';
// put full path to Smarty.class.php
require_once('/usr/share/php/smarty/libs/Smarty.class.php');
$smarty = new Smarty();

$smarty->template_dir = 'templates';
$smarty->compile_dir = 'templates_c';
$smarty->cache_dir = 'cache';
$smarty->config_dir = 'configs';

// ligação à base de dados
$db = dbconnect($hostname,$db_name,$db_user,$db_passwd);
if($db) {
  // criar query numa string
  $query  = "SELECT microposts.title, microposts.content, microposts.created_at, microposts.updated_at, users.name
			 FROM microposts, users
			 WHERE microposts.user_id = users.id
			 ORDER BY microposts.created_at DESC";
      
  // executar a query
  if(!($result = @ mysqli_query($db,$query)))
  {
   showerror($db);
  }
  


  // vai buscar o resultado da query
  $nrows  = mysqli_num_rows($result);
   for($i=0; $i<$nrows; $i++)
   {
     $tuple[$i] = mysqli_fetch_array($result,MYSQL_ASSOC);
   }
 
  // faz a atribuição das variáveis do template smarty
  $smarty->assign('Post',$tuple);
  $smarty->assign('Menu0',"home");
  $smarty->assign('Menu1',"logout");
  $smarty->assign('Menu2',"post");
  $smarty->assign('Welcome',"Welcome Bruno Serro");

  // Mostra a tabela
  $smarty->display('templates_c/index_template.tpl');
  
  // fechar a ligação à base de dados
  mysqli_close($db);
} // end if


?>