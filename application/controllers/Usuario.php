<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario extends CI_Controller{


	
	public function cadastrar(){
		if($this->session->userdata("usuario_logado")){
			//usando helper
			$this->load->helper(array("url","form"));

			$this->load->view("usuario/formulario.php");
		}else{
			redirect('usuario/logar', 'refresh');
		}

	}

	public function logar(){
		$this->load->helper(array("url","form"));

		$this->load->view("usuario/login.php");

	}
	
	public function deslogar(){
		if($_SESSION['usuario_logado']){
			//destruindo sessão
			unset($_SESSION['usuario_logado']);
			//redirecionando usuario
			$this->load->helper('url');
			redirect('usuario/logar', 'refresh');
		}
		redirect('produtos/logar', 'refresh');
	}



	public function adiciona(){
		//carrega biblioteca de validação
		$this->load->library('form_validation');
		//cria regras
//                              set_rules(name , nomeMostradoNaMensagem, Regra, array muda escrita)
    	$this->form_validation->set_rules('nome', 'Nome', 'trim|required|min_length[4]|max_length[100]|alpha',
    		array('required' => 'Você deve preencher o campo %s.',
    			  'alpha' => 'O campo nome aceita apenas letras',
    			  'min_length' => 'numero minimo de caracteres no campo %s é 4'
    		));
    	$this->form_validation->set_rules('email', 'Email', 'required|valid_email', 
    		array('required' => 'Você deve preencher o campo %s.',
    			  'valid_email' => 'O campo %s deve conter um endereço de email válido'
    		));
    	$this->form_validation->set_rules('senha', 'Senha', 'required|min_length[6]', 
    		array('required' => 'Você deve preencher o campo %s.',
    			  'min_length' => 'numero minimo de caracteres no campo %s é 6'
    		));
    	$this->form_validation->set_rules('senhaconf', 'Senha de confirmação', 'required|min_length[6]|matches[senha]', 
    		array('required' => 'Você deve preencher o campo %s.',
    			  'matches' => 'As senhas digitas não são iguais',
    			  'min_length' => 'numero minimo de caracteres no campo %s é 6'
    		));
		
    

    	//cria usuario com os dados
	    	$usuario = array(
		        "nome" => $this->input->post("nome"),
		        "email" => $this->input->post("email"),
		        "senha" => $this->input->post("senha")
    		);


    	//roda a validação
    	if ($this->form_validation->run() == FALSE) {

	        $this->load->view('usuario/formulario.php');
	    }else{

	    	//salva usuario no banco
	    	$this->load->database();
	    	$this->load->model("usuario_model");
	    	//criptografando senha
	    	$usuario['senha'] = md5($usuario['senha']);
	    	$this->usuario_model->salva($usuario);


	    	$this->load->view("usuario/novo.php");
	    }

    	
	}

	public function entrar(){

		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email', 
    		array('required' => 'Você deve preencher o campo %s.',
    			  'valid_email' => 'O campo %s deve conter um endereço de email válido'
    		));
		$this->form_validation->set_rules('senha', 'Senha', 'required|min_length[6]', 
    		array('required' => 'Você deve preencher o campo %s.',
    			  'min_length' => 'numero minimo de caracteres no campo %s é 6'
    		));

		//cria usuario com os dados
	    	$usuario = array(
		        "email" => $this->input->post("email"),
		        "senha" => $this->input->post("senha")
    		);

		if ($this->form_validation->run() == FALSE) {
			$dados = array('mensagens' => validation_errors(),'usuarios' => $usuario);
			$this->load->helper(array("url","form"));

			$this->load->view('usuario/login.php', $dados);
		}else{
			$this->load->database();
	    	$this->load->model("usuario_model");

	    	//criptografando senha
	    	$usuario['senha'] = md5($usuario['senha']);
	 
	    	//verificar existencia de usuario
	    	$email = $usuario['email'];
	    	$senha = $usuario['senha'];
	    	$resultadoUsuario = $this->usuario_model->procuraUsuario($email,$senha);
	    	if($resultadoUsuario){
	    		$this->load->library('session');
	    		$this->session->set_userdata("usuario_logado", $resultadoUsuario);
	    		//flashdata session para uma requisição apos isso ela apaga automaticamente
	    		$this->session->set_flashdata('mensagem', 'Logado com sucesso');
	    		//$this->session->set_userdata("mensagem", "Logado com sucesso");
            	//$dados = array("mensagem" => "Logado com sucesso!");
            	//redirecionar 
            	$this->load->helper('url');
            	redirect('produtos/listar', 'refresh');
            	//$this->load->view('produtos/listar', $dados);
	    	}else{
	    		$dados = array("mensagem" => "Não foi possível fazer o Login!");
	    		$this->load->view('usuario/login.php', $dados);
	    	}


	    	
		}
	}
	
}