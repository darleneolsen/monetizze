<?php
/**
 * Class IntegracaoTelesena
 */
class monetizzeJogos{
    /**
     * @var quantidadeDezenas
     */
    private $quantidadeDezenas;
    /**
     * @var totalJogos
     */
    private $totalJogos;
    /**
     * @var resultados
     */
    private $resultados; 
    
    /**
     * @var jogos
     */
    private $jogos;
	
	
    /**
     * monetizzeJogos constructor.
     * @param $quantidadeDezenas
	 * @param $totalJogos
     */
	 
    public function __construct($quantidade, $total)
    {
		
        $this->setQuantidadeDezenas($quantidade);
        $this->setTotalJogos($total);
	
        
    }
	
	
	public function getQuantidadeDezenas() {
	
		return $this->quantidadeDezenas;
	
	}
	
  	/**
	 * @param $quantidade
     */    
	public function setQuantidadeDezenas($quantidade) {
		$this->quantidadeDezenas= $quantidade;
	}


	public function getTotalJogos() {
		return $this->totalJogos;
	}
	
 	/**
	 * @param $total
     */   
	public function setTotalJogos($total) {
		$this->totalJogos= $total;
	}	
	
	
	public function getResultados() {
		return $this->resultados;
	}
  
  
 	/**
	 * @param $dados
     * @return array
     */   
	public function setResultados($dados) {
		$this->resultados= $dados;
	}		
	
	
	public function getJogos() {
		return $this->jogos;
	}
  
  
 	/**
	 * @param $dadosJogos
     * @return array
     */ 
	public function setJogos($dadosJogos) {
		$this->jogos= $dadosJogos;
	}			
	
	
	private function verificaQuantidadeDezenas(){
		$dezenasValidas = array (6,7,8,9,10);
	

		if(!in_array($this->getQuantidadeDezenas(), $dezenasValidas))
		{
			
			 throw new Exception('Quantidade de dezenas tem que ser entre 6,7,8,9,10');
		}
	
	}
	
	/**
	 * Gera o array de dezenas de acordo com cardinalidade do atributo quantidadeDezenas
     * @return array
     */
	private function dezenas(){
		//Verifica se dezena passada é válida
	
		try {
			$this->verificaQuantidadeDezenas();

			$quantidadeDezenas = $this->getQuantidadeDezenas();
			$dezenasArray 	   = array();
			$i =0;
			do{
				//Gera número aleatório
				$numeroGerado = $this->gerarNumeros();
				
				//Verifica se já existe no array
				if(!in_array($numeroGerado, $dezenasArray)){
					$dezenasArray[] =  $numeroGerado;
					$i++;
				}
				
			}while($i < $quantidadeDezenas );
			
			//Orderna o array crescente
			sort($dezenasArray);

			//Percorre o array ordenado
			foreach ($dezenasArray as $key => $val) {
				$dezenasArray[$key] = $val;
			}
		
			return $dezenasArray;
			
		} catch (Exception $e) {
			echo 'Exceção capturada: ',  $e->getMessage(), "\n";
		}
		
				

	}
	/**
	 * Gera números aleatórios
     * @return array
     */	
	
	private function gerarNumeros(){
		
		return rand(1, 60);
	}
	
	/**
	 * Gerar jogos
     * @return array
     */
	public function jogos(){
		
		//Pega o valor do atributo $totalJogos
		$totalJogos = $this->getTotalJogos();
		$jogos		= array();
		//Percorre a quantidade para gerar o array multidimensional 
		
		for($i=0;$i<$totalJogos;$i++){
			//Chama a função que gera as dezenas
			$jogos[$i] = $this->dezenas();
					
		}
		//atribui na variavel totalJogos
		$this->setJogos($jogos);
	}
	
	/**
	 * Gera o array de sorteios
     * @return array
     */
	public function sorteios(){

		$sorteiosArray 	   = array();
		$i=0;
		do{
			//Gera número aleatório
			$numeroGerado = $this->gerarNumeros();
			
			//Verifica se já existe no array
			if(!in_array($numeroGerado, $sorteiosArray)){
				$sorteiosArray[] =  $numeroGerado;
				$i++;
			}	
		
		}while($i < 6 );
		
		
	
		//Orderna o array crescente
		sort($sorteiosArray);

		//Percorre o array ordenado
		foreach ($sorteiosArray as $key => $val) {
			$sorteiosArray[$key] = $val;
		}
		//atribui na variavel resultados
		$this->setResultados($sorteiosArray);
		
	}
	
	/**
	 * Gera o array de resultados
     * @return array
     */
	public function resultados(){

		$sorteio 	= $this->getResultados();
		$jogos		= $this->getJogos();
		
		
		for($i=0;$i<count($jogos);$i++){
			$resultado['acertos'][$i]	= 0;
			for($y=0;$y<count($jogos[$i]);$y++){
						
				//Verifica valor  existe no array
				if(in_array($jogos[$i][$y], $sorteio)){
					$resultado['acertos'][$i] +=  1;
					
				}	
				
			}			
	
		}
		$resultado['sorteio'] = $sorteio;
		$resultado['jogos'] = $jogos;
	
		return $resultado;
	}	
}
?>
