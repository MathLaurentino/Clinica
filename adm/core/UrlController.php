<?php

namespace Core;

class UrlController extends Define
{
    
    private string $url; //$url Recebe a URL do .htaccess
    private array $urlArray; // $urlArray Recebe a URL convertida para array 
    
    private string $urlController; // $urlController Recebe da URL o nome da controller 
    private string $urlMetodo; // $urlMetodo Recebe da URL o nome do método
    
    private string $classLoad;

    private string $urlSlugController;
    private string $urlSlugMetodo;



    /**
     * Recebe a URL do .htaccess
     * Validar a URL
     */
    public function __construct()
    {
        $this->configAdm();

        if(!empty(filter_input(INPUT_GET, 'url', FILTER_DEFAULT))){

            $this->url = filter_input(INPUT_GET, 'url', FILTER_DEFAULT);

            $this->clearUrl();

            $this->urlArray = explode("/", $this->url);

            // Se tiver passado a controller na URL
            if(isset($this->urlArray[0])) {
                $this->urlController = $this->slugController($this->urlArray[0]);
            }else{
                $this->urlController = CONTROLLER; //login
            }

            // Se tiver passado o método da controller na URL
            if (isset($this->urlArray[1])){
                $this->urlMetodo = $this->slugMetodo($this->urlArray[1]);
            }else{
                $this->urlMetodo = METODO; //index
            }

        }else{
            $this->urlController = CONTROLLERERRO; //login
            $this->urlMetodo = METODO; //index
        }
    }


    
    /**     function clearUrl()
     * Método chamado pelo construction
     * É responsável por limpar a URL 
     *      - tira as tags html e php
     *      - tira o espaço do final e enicio da url
     *      - tira a barra do final da url
     *      - retira os caracteres especiais
     */
    private function clearUrl(): void
    {
        $this->url = strip_tags($this->url); //tira as tags html e php
        $this->url = trim($this->url); //tira o espaço do final e enicio da url
        $this->url = rtrim($this->url, "/"); //tira a barra do final da url

        //Retira os caracteres especiais e substitui pelos do format['b']
        $format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]?;:.,\\\'<>°ºª ';
        $format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr-------------------------------------------------------------------------------------------------';
        $this->url = strtr(utf8_decode($this->url), utf8_decode($format['a']), $format['b']);
    }



    /**     function slugController()
     * Método chamado pelo contruction
     * É responsavel por limpar o nome da controller
     *      - converte para minusculo
     *      - converte o traço para espaco em braco
     *      - converter a primeira letra de cada palavra para maiusculo
     *      - retira o espaco em branco
     */
    private function slugController(string $slugController): string
    {
        $this->urlSlugController = strtolower($slugController); //Converter para minusculo
        $this->urlSlugController = str_replace("-", " ", $this->urlSlugController); //Converter o traço para espaco em braco
        $this->urlSlugController = ucwords($this->urlSlugController); //Converter a primeira letra de cada palavra para maiusculo
        $this->urlSlugController = str_replace(" ", "", $this->urlSlugController); //Retirar espaco em branco

        return $this->urlSlugController;
    }



    /**     function slugMetodo()
     * Método chamado pelo contruction
     * É responsavel por limpar o nome do método da controller
     *      - converte a primeira letra do $urlSlugMetodo para minusculo
     */
    private function slugMetodo(string $urlSlugMetodo): string
    {
        $this->urlSlugMetodo = $this->slugController($urlSlugMetodo);
        $this->urlSlugMetodo = lcfirst($this->urlSlugMetodo); // primeira letra para minusculo
        
        return $this->urlSlugMetodo;
    }



    /**     function verifyPage() 
     * Carregar as Controllers
     * Instanciar as classes da controller e carregar o método 
     */
    public function verifyPage(): void
    {
        $this->classLoad = "\\App\\adms\\Controllers\\" . $this->urlController; 
        if(class_exists($this->classLoad)){
            $this->verifyMethod();
        }else{
            $this->urlController = CONTROLLERERRO;
            $this->verifyPage();
        }
    }



    /**     function verifyMethod()
     * Verifica se o método existe dentro da classe e executa ele
     */
    private function verifyMethod()
    {
        //classLoad é uma variavel mas com () no final para declara uma classe
        $page = new $this->classLoad(); 
        if(method_exists($page, $this->urlMetodo)){
            $method = $this->urlMetodo;
            $page->$method();
        }else{
            //die("Erro: pagina não encontrada");
            echo $methodo;
            echo $page;
        }
    }
}
