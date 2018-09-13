    public function upload(){
        
        $result = new retJSON();
        try{
            $date = strtotime("now"); 
            $uploaddir = $this->gerarDirName($_SESSION['idEA1']);
            foreach ($_FILES as $k=>$file){
                $tmp_filename = $file['tmp_name'];
                if (is_uploaded_file($tmp_filename)) {
                    $target_file = $date."_".$file['name'];
                    $origem = $file['tmp_name'];
                    
                    if (move_uploaded_file($origem, $uploaddir . "/".$target_file ) ) {
                        $result->success = true;
                        $result->message = "Arquivo recebido com sucesso!";
                        $result->content = "$target_file";
                        unlink($origem);
                    } else
                        throw new \Exception('Erro no processo de upload do arquivo.');
                }
            }
        }
        catch(\Exception $e){
            $result->error = true;
            $result->message = $e->getMessage();
        }
        $this->returnJSON($result);
        
    }
    
    private function gerarDirName($idEA1){
        
        $path = $_SERVER['DOCUMENT_ROOT'].'/imagens';
        // Subdiretorio da Empresa onde serao colocados os arquivos.
        $pathEmp = '/EMP' . str_pad ( $this->getServer()->getSession("idEA1"), 6, '0', STR_PAD_LEFT );
        // Diretorio da Empresa onde serao colocados os arquivos.
        $pathAssinatura = "/assinaturas";
        
        // Se o diretorio nao existir, cria.
        (! file_exists ( $path )) ? mkdir ( $path, 0775 ) : '';
        // Se o subdiretorio da Empresa nao existir, cria.
        (! file_exists ( $path . $pathEmp )) ? mkdir ( $path . $pathEmp, 0775 ) : '';
        // Se o subdiretorio da Empresa nao existir, cria.
        (! file_exists ( $path . $pathEmp . $pathAssinatura )) ? mkdir ( $path . $pathEmp . $pathAssinatura, 0775 ) : '';
        
        return $pathFull = $path.$pathEmp.$pathAssinatura;

    }
