<?php
    chdir(dirname(__DIR__));

    require 'src/config.php';
    require 'src/functions/connection.php';


    $page = isset($_GET['url']) ? $_GET['url'] : 'home';

    /*
    if(!file_exists($page = VIEWS . '/' . $page . '.phtml')){
        require VIEWS . '/404.phtml';
        die;
    } */

   $page = explode('/', $page);
  
    
    if($page[0] == 'users'){

        require 'src/functions/users.php';

        if($page[1] == 'list'){
            $users = getAll(connection());
            require VIEWS . '/users/index.phtml';
        }
        if($page[1] == 'edit'){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                
                $data = $_POST;

                if(!update(connection(), $data)){
                    $msg = 'Erro ao atualizar usuário';
                    header("Location: " . HOME . '/?url=users/list&msg=' . $msg);
                }

                $msg = 'Usuário atualizado com sucesso!';
                header("Location: " . HOME . '/?url=users/list&msg=' . $msg);

            }

            if($_SERVER['REQUEST_METHOD'] == 'GET'){
            $user = get(connection(), $_GET['id']);

            if(!$user){
                $msg = 'Usuário não existe!';
                header("Location: " . HOME . '/?url=users/list&msg=' . $msg);
            }

            require VIEWS . '/users/edit.phtml';
            }
        }

        if($page[1] == 'save'){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $data = $_POST;
                if(!create(connection(), $data)){
                    $msg = 'Erro ao inserir usuário';
                    header("Location: " . HOME . '/?url=users/list&msg=' . $msg);
                }

                $msg = 'Usuário inserido com sucesso!';
                header("Location: " . HOME . '/?url=users/list&msg=' . $msg);
            }
            require VIEWS . '/users/save.phtml';
        }
    }

    if($page[0] == 'products'){

        if($page[1] == 'list'){
            require VIEWS . '/products/index.phtml';
        }

        if($page[1] == 'save'){
            require VIEWS . '/products/save.phtml';
        }
    }
    
?>