<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Produtos extends CI_Controller{

	public function adiciona() {
		if($this->session->userdata("usuario_logado")){
			$this->load->view("cabecalho");
        	$this->load->view("produtos/formulario");
        	$this->load->view("rodape");
		}else{
			redirect('usuario/logar', 'refresh');
		}
		
    }

	public function listar(){
	 	$produtos = array();
	 	//carrega modelo
    	$this->load->model('produtos_model');
    	$this->load->database();

    	//passar consulta para variavel
    	$produtos = $this->produtos_model->buscaTodos();
    	
    	$dados = array("produtos" => $produtos);

    	$this->load->helper("url");
    	$this->load->helper("form");
    	$this->load->view("produtos/index.php" , $dados);
	}
	
	public function novo(){
		if($this->session->userdata("usuario_logado")):
		$this->load->library('form_validation');

		$this->form_validation->set_rules('nome','Nome',
			'regex_match[/[a-zA-z\s]/]|trim|required|min_length[2]|max_length[150]',
		array(
			'required'=>'O campo nome não foi preenchido',
			'regex_match' => 'O campo nome aceita apenas letras',
			'min_length' =>'O campo nome aceita no minimo dois caracteres',
			'min_length' =>'O campo nome aceita no maximo cento e cinquenta caracteres'
		));

		$this->form_validation->set_rules('preco','Preço','required|trim|numeric|min_length[2]|max_length[15]',array(
			'required'=>'O campo %s não foi preenchido',
			'numeric' => 'O campo %s aceita apenas numeros',
			'min_length' =>'O campo nome no minimo dois caracteres',
			'min_length' =>'O campo nome aceita no maximo cento e cinquenta caracteres'
		));

		$this->form_validation->set_rules('descricao','Descrição','required|trim|min_length[2]|max_length[150]',array(
			'required'=>'O campo %s não foi preenchido',
			'min_length' =>'O campo %s aceita no minimo dois caracteres',
			'min_length' =>'O campo %s aceita no maximo cento e cinquenta caracteres'
		));

		if($this->form_validation->run() == FALSE){
			
			$this->load->view("cabecalho");
       	 	$this->load->view("produtos/formulario");
        	$this->load->view("rodape");
		}else{

			$this->load->database();
			$this->load->model('produtos_model');
			//chamando session do usuario
			$usuarioLogado = $this->session->userdata("usuario_logado");
			//var_dump($usuarioLogado);die();

			$produto = array(
				'nome' => $this->input->post('nome'),
				'preco' => $this->input->post('preco'),
				"usuario_id" => $usuarioLogado["id"],
				'descricao' => $this->input->post('descricao')
			);
			$result = $this->produtos_model->adiciona($produto);
			if($result){
				$this->session->set_flashdata('mensagemSucesso', 'Produto adicionado com sucesso'); 
				redirect('produtos/adiciona', 'refresh');
			}else{
				$this->session->set_flashdata('mensagemErro', 'O produto não foi adicionado'); 
				redirect('produtos/adiciona', 'refresh');
			}


		}
		else:
			redirect('usuario/logar', 'refresh');
		endif;


		
	}
}