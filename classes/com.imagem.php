<?php
class IMAGEM {
	// REDIMENSIONA A IMAGEM PARA 640x480
	private function editar($source, $imgSize) {
		$percent = ($imgSize[0] > $imgSize[1]) ? (64000/$imgSize[0])/100 : (48000/$imgSize[1])/100;
		$newLarg = ($imgSize[0]*$percent);
		$newAltu = ($imgSize[1]*$percent);
		$thumb = imagecreatetruecolor($newLarg, $newAltu);
		@imagecopyresized($thumb, $source, 0, 0, 0, 0, $newLarg, $newAltu, $imgSize[0], $imgSize[1]);
		return $thumb;
	}

	// ENVIA A IMAGEM PARA A PASTA NO SISTEMA
	private function enviar($img, $destino) {
		$tipos = array("jpg", "png", "jpeg", "gif");
		$tipo = pathinfo($img['imagem']['name'], PATHINFO_EXTENSION);
		$check = getimagesize($img['imagem']['tmp_name']);
		if($check !== false) {
			if(in_array($tipo, $tipos)) {
				if(move_uploaded_file($img['imagem']['tmp_name'], $destino)) {
					return true;
				} else return "Erro: problema no envio da imagem.";
			} else return "Erro: tipo de imagem inválida. Só são permitidas imagens JPG, PNG e GIF";
		} else return "Erro: o arquivo não é uma imagem válida.";
	}

	public static function salvar($caminho, $img) {
		$ext = pathinfo($img['imagem']['name'], PATHINFO_EXTENSION);
		$imagem = time().'.'.$ext;
		$destino = $caminho.$imagem;
		while(file_exists($destino)) {
			$i = 0;
			$imagem = time().'-'.$i.'.'.$ext;
			$destino = $caminho.$imagem;
			$i++;
		}
		if(($resul = self::enviar($img, $destino)) === true) {
			$imgSize = getimagesize($destino);
			switch ($ext) {
				case 'jpg':
				case 'jpeg':
					$source = @imagecreatefromjpeg($destino);
					break;
				
				case 'png':
					$source = @imagecreatefrompng($destino);
					break;

				case 'gif':
					$source = @imagecreatefromgif($destino);
					break;
			}
			imagejpeg(self::editar($source, $imgSize), $destino);
			return array(true, $imagem, $destino);
		} else {
			return array(false, $resul);
		}
	}
}
?>