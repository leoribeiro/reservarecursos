<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $configPam;
	private $users;

	public function validaAdmin(){
		$this->configPam = new ConfigApp();
		$this->users=array(
			'admin'=>$this->configPam->passAdmin,
		);
		if(isset($this->users[$this->username])){
			if($this->users[$this->username]==$this->password){
				$this->errorCode=self::ERROR_NONE;
				$roles = array('admin');
				$this->setState('roles', $roles);
				return true;
			}
			else{
				$this->errorCode = self::ERROR_PASSWORD_INVALID;
			}
		}
		return false;
	}


	public function authenticate()
	{
		$this->errorCode = self::ERROR_PASSWORD_INVALID;


		if(!$this->validaAdmin()){

			$controle = new ControleLogin();
			// Estabiliza uma conexão com o LDAP do CEFETMG
			$ds = $controle->conectaLDAP();

			if($ds){

				$boolServidor = $controle->autenticaLDAP($ds,'servidor',
				$this->username,$this->password);


				// carrega a variável com o model do usuário
				$servidor = $controle->VerificaServidorBD($this->username);

				if($boolServidor && ($servidor != null)){

						$roles[] = 'visualizacao';
						$this->errorCode = self::ERROR_NONE;

						// setando as regras do usuario
						$this->setState('roles', $roles);

						$this->setState('CDServidor', $servidor->CDServidor);

				}

			}
		}

		return !$this->errorCode;
	}
}