<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Qual é o seu Signo?</title>
</head>
<body>
    <main>
        <h1>Descubra qual é o seu Signo</h1>
        <form action="/index.php" method="POST">
            <p>Digite o dia e mês de Nascimento:</p>
            <input type="number" name="day" id="DateDay" required="required" placeholder="Dia" autocomplete="off">
            <input type="number" name="month" id="DateMonth" required="required" placeholder="Mês" autocomplete="off">
            <br>
            <br>
            <button type="submit" id="txtSubmit">
                Enviar
            </button>
        </form>

        <p>Já sabe seu signo?! Escolha:</p>
        <nav>
            <button><a href="https://www.personare.com.br/horoscopo-do-dia/aries" target="_blank">ÁRIES</a></button>
            <button><a href="https://www.personare.com.br/horoscopo-do-dia/touro" target="_blank">TOURO</a></button>
            <button><a href="https://www.personare.com.br/horoscopo-do-dia/gemeos" target="_blank">GÊMEOS</a></button>
            <button><a href="https://www.personare.com.br/horoscopo-do-dia/cancer" target="_blank">CÂNCER</a></button>
            <button><a href="https://www.personare.com.br/horoscopo-do-dia/leao" target="_blank">LEÃO</a></button>
            <button><a href="https://www.personare.com.br/horoscopo-do-dia/virgem" target="_blank">VIRGEM</a></button>
            <button><a href="https://www.personare.com.br/horoscopo-do-dia/libra" target="_blank">LIBRA</a></button>
            <button><a href="https://www.personare.com.br/horoscopo-do-dia/escorpiao" target="_blank">ESCORPIÃO</a></button>
            <button><a href="https://www.personare.com.br/horoscopo-do-dia/sagitario" target="_blank">SAGITÁRIO</a></button>
            <button><a href="https://www.personare.com.br/horoscopo-do-dia/capricornio" target="_blank">CAPRICÓRNIO</a></button>
            <button><a href="https://www.personare.com.br/horoscopo-do-dia/aquario" target="_blank">AQUÁRIO</a></button>
            <button><a href="https://www.personare.com.br/horoscopo-do-dia/peixes" target="_blank">PEIXES</a></button>
        </nav>
    </main>
    <?php
    if (isset($_POST['day'])) {

        $dia = $_POST['day'];
        $mes = intval($_POST['month']);
    
        $xml = simplexml_load_file('signos.xml');
        
        for ($i=0; $i < count($xml->signo); $i++) { 
            $inicioDia = explode('/', $xml->signo[$i]->dataInicio)[0];
            $inicioMes = intval(explode('/', $xml->signo[$i]->dataInicio)[1]);
            
            $fimDia = explode('/', $xml->signo[$i]->dataFim)[0];
            $fimMes = intval(explode('/', $xml->signo[$i]->dataFim)[1]);
    
            $ano_anterior = 1920;
            $proximo_ano = 1921;
            $ano = $ano_anterior;
    
            $inicio = new DateTime( $ano.'-'.$inicioMes.'-'.$inicioDia);
    
            if ($inicioMes > $fimMes) { $ano = $proximo_ano; }
            $fim = new DateTime( $ano.'-'.$fimMes.'-'.$fimDia);
            
            if ($mes != $fimMes) { $ano = $ano_anterior; }
            $dataAniversario = new DateTime( $ano."-$mes-$dia");
        
            if ($dataAniversario >= $inicio && $dataAniversario <= $fim){
                echo "<h1>O seu signo é: ". $xml->signo[$i]->signoNome . "</h1>";
                break;
            }
        }
    }
    // NAO ENCONTROU NADA
?>
    
</body>
</html>