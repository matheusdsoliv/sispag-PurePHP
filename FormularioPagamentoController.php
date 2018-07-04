<?php
    session_start();
    require_once("Library.php");

    //PASSO 1
    // Recebendo dados do formulário
    $_dados = array(
         'cpf' => $_POST['cpf'],
         'funcionario' => $_POST['funcionario'],
         'ano_nascimento' => $_POST['ano_nascimento'],
         'salario_base' => $_POST['salario_base'],
         'qtd_filhos' => $_POST['qtd_filhos']
    );

    // PASSO 2
    // PROCESSAMENTO DOS DADOS
    $_SESSION['funcionario'] = $_dados['funcionario'];
    $_SESSION['idade'] = calc_idade($_dados['ano_nascimento']);
    $_SESSION['cpf'] = $_dados['cpf'];
    $_SESSION['salario_base'] = $_dados['salario_base'];
    $_SESSION['qtd_filhos'] = $_dados['qtd_filhos'];
    $_SESSION['abono'] = calc_abono($_SESSION['idade']);
    $_SESSION['salario_familia'] = calc_sal_familia($_dados['qtd_filhos']);
    $_SESSION['salario_bruto'] = $_dados['salario_base'] + calc_sal_familia( $_dados['qtd_filhos'] ) + calc_abono( $_SESSION['idade'] );
    $_SESSION['inss'] = calc_inss( $_SESSION['salario_bruto'] );
    $_SESSION['salario_liquido'] = calc_sal_liq($_SESSION['salario_bruto'], $_SESSION['inss']); 

    // require("ApresentaçãoCupomSalarial.php");

    // PASSO 3
    // EXIBIR OS DADOS - PARA TESTE
    // imprime($_idade, $_abono, $_salario_familia, $_salario_bruto, $_inss, $_salario_liquido);
    // print_r($_SESSION);
    // exit;

    // PASSO 4
    // REDIRECIONAR À PÁGINA DE APRESENTAÇÃO DO CUMPOM FISCAL
    header("Location:ApresentaçãoCupomSalarialView.php");


?>