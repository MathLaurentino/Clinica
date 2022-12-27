<?php

namespace App\Adms\Controllers;

if (!defined('D7E4T2K6F4')) {
    $header = "http://localhost/Clinica/Erro?case=404"; // Erro 404
    header("Location: {$header}");
}

include_once 'app/Adms/controllers/helpers/protect.php';

class FotoServico
{

    
    private array|null $data = null;
    private array|null $dataForm = null;

    private string|null $idservico = null;
    private string $nameInDB;


    public function index()
    {
        $this->adicionar();
    }



    /**     function usuario()
     * Cadastra uma foto de perfil do usuario
     */
    public function adicionar(): void
    {

        if (isset($_GET['idservico'])) {
            $this->idservico = $_GET['idservico'];
        }   

        $AdmsFotoServico = new \Adms\Models\AdmsFotoServico();

        // verifica se o id do servico passado pela URL existe no banco de dados
        if ($AdmsFotoServico->verifyIdServico($this->idservico)) {
            
            if (!isset($_FILES['arquivo'])) {
                $this->view("fotoServico");
            } 
            
            else {
                
            }

        } else {
            $_SESSION['msg'] = "id de serviço não encontrado";
            $header = URLADM . "SobreClinica"; 
            header("Location: {$header}");
        }
        

        // // so é possivel acessar o método se não existir a $_SESSION['foto_usuario'] 
        // // (no caso se não tiver foto cadastrada)
        // if (!isset($_SESSION['foto_usuario'])) { 

        //     if (isset($_FILES['arquivo'])) { // se o usuario mandou o arquivo de foto 

        //         $StsFile = new \Sts\Models\helpers\StsFile();
                
        //         if ($StsFile->verifyFile($_FILES['arquivo'])) { // se a foto segue as regras de negocio

        //             $nameInDB = $StsFile->saveFile($_FILES['arquivo']);

        //             if (!empty($nameInDB)) { // se conseguiu salvar na pasta assets/imagens
        //                 $this->data = ['foto_usuario' => $nameInDB];

        //                 $stsCreate= new \Sts\Models\StsFotoUsuario();
        //                 $result = $stsCreate->cadastroFoto($this->data);

        //                 if ($result) { // se salvar corretamente no BD
        //                     $_SESSION['foto_usuario'] = $this->data['foto_usuario'];
        //                     $_SESSION['msg'] = "Foto salva com sucesso";
        //                     $header = URL . "Sobre-Cliente/Dados"; 
        //                     header("Location: {$header}");
        //                 } else { // se não salvar corretamente no BD
        //                     $header = URL . "Erro?case=13"; // Erro 013
        //                     header("Location: {$header}");
        //                 }

        //             } else { // se não conseguiu salvar na pasta assets/imagens
        //                 // recarrega a pagina mostrando o erro pro usuario 
        //                 $header = URL . "Foto/Usuario"; 
        //                 header("Location: {$header}");
        //             }

        //         } else { // se a foto não segue as regras de negocio
        //             $header = URL . "Foto/Usuario"; 
        //             header("Location: {$header}");
        //         } 

        //     } else { // caso n tenha arquivo enviado, carrega a tela
        //         $this->view("usuario");
        //     }

        // } else {
        //     $header = URL . "Erro?case=14"; // Erro 014
        //     header("Location: {$header}");
        // }   
    }



    private function view($view) 
    {
        $loadView = new \Core\LoadView("Adms/Views/bodys/files/" . $view, $this->data, null);
        $loadView->loadView();
    }
}

?>
