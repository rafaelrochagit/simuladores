<?php
error_reporting(E_ALL);
error_reporting(E_ERROR);

$base_url = __DIR__."/";
if($_SERVER['HTTP_HOST'] == 'localhost') $base = "/simuladores";
else $base = "";

ob_start();

require_once $base_url.'inss/INSS.php'; 	
require_once $base_url.'irpf/IRPF.php'; 	
require_once $base_url.'irpf_plr/IRPF_PLR.php'; 	
require_once $base_url.'clt/CLT.php'; 	
require_once $base_url.'pj/PJ.php'; 	
require_once $base_url.'mei/MEI.php'; 	
require_once $base_url.'clt_pj/CLT_PJ.php';
require_once $base_url.'clt_mei/CLT_MEI.php';
require_once $base_url.'pj_clt/PJ_CLT.php'; 	
require_once $base_url.'mei_clt/MEI_CLT.php'; 	
require_once $base_url.'juros_compostos/JC.php'; 	
require_once $base_url.'ponto/PONTO.php'; 	
require_once $base_url.'util.php'; 	

date_default_timezone_set('America/Sao_Paulo');
$pagina = isset($page) ? $page : 'home';

session_start();
$usuarioLogado = isset($_SESSION["user"]) ? $_SESSION["user"] : null;

$msg = isset($_SESSION["msg"]) ? $_SESSION["msg"] : null;
unset($_SESSION["msg"]);
$msgSuccess = isset($_SESSION["msgSuccess"]) ? $_SESSION["msgSuccess"] : null;
unset($_SESSION["msgSuccess"]);
$erroForm = isset($_SESSION["erroForm"]) ? $_SESSION["erroForm"] : null;
unset($_SESSION["erroForm"]);

$inss = new INSS();
$irpf = new IRPF();
$irpfPlr = new IRPF_PLR();
$clt = new CLT();
$pj = new PJ();
$mei = new MEI();
$cltPj = new CLT_PJ();
$cltMei = new CLT_MEI();
$pjClt = new PJ_CLT();
$meiClt = new MEI_CLT();

$jc = new JC();
$ponto = new PONTO();

$codSimulacaoCltAtual = isset($_GET['codSimulacaoClt']) ? $_GET['codSimulacaoClt'] : '';
$codSimulacaoPjAtual = isset($_GET['codSimulacaoPj']) ? $_GET['codSimulacaoPj'] : '';
$codSimulacaoMeiAtual = isset($_GET['codSimulacaoMei']) ? $_GET['codSimulacaoMei'] : '';
$codSimulacaoJcAtual = isset($_GET['codSimulacaoJc']) ? $_GET['codSimulacaoJc'] : '';
$codSimulacaoPontoAtual = isset($_GET['codSimulacaoPonto']) ? $_GET['codSimulacaoPonto'] : '';

$codSimulacaoClt = getIdUsuario();
$codSimulacaoPj = getIdUsuario();
$codSimulacaoMei = getIdUsuario();
$codSimulacaoJc = getIdUsuario();
$codSimulacaoPonto = getIdUsuario();

$simulacoesClt = $clt->readSimulacoes();
$cltLiquido = isset($simulacoesClt["cltLiquido".$codSimulacaoCltAtual]) ? $simulacoesClt["cltLiquido".$codSimulacaoCltAtual] : null;

$simulacoesPj = $pj->readSimulacoes();
$pjLiquido = isset($simulacoesPj["pjLiquido".$codSimulacaoPjAtual]) ? $simulacoesPj["pjLiquido".$codSimulacaoPjAtual] : null;

$simulacoesMei = $mei->readSimulacoes();
$meiLiquido = isset($simulacoesMei["meiLiquido".$codSimulacaoMeiAtual]) ? $simulacoesMei["meiLiquido".$codSimulacaoMeiAtual] : null;

$simulacoesJc = $jc->readSimulacoes();
$jcResult = isset($simulacoesJc["jc".$codSimulacaoJcAtual]) ? $simulacoesJc["jc".$codSimulacaoJcAtual] : null;

$simulacoesPonto = $ponto->readSimulacoes();
$pontoResult = isset($simulacoesPonto["ponto".$codSimulacaoPontoAtual]) ? $simulacoesPonto["ponto".$codSimulacaoPontoAtual] : null;

$simulacoesCltPj = $cltPj->readSimulacoes();
$simulacoesCltMei = $cltMei->readSimulacoes();
$simulacoesPjClt = $pjClt->readSimulacoes();
$simulacoesMeiClt = $meiClt->readSimulacoes();

if($codSimulacaoCltAtual != '') $codSimulacaoClt = $codSimulacaoCltAtual;
if($codSimulacaoPjAtual != '') $codSimulacaoPj = $codSimulacaoPjAtual;
if($codSimulacaoMeiAtual != '') $codSimulacaoMei = $codSimulacaoMeiAtual;
if($codSimulacaoJcAtual != '') $codSimulacaoJc = $codSimulacaoJcAtual;
if($codSimulacaoPontoAtual != '') $codSimulacaoPonto = $codSimulacaoPontoAtual;

$config = readConfig();
$tabelaNome = isset($config['tabela_inss']) ? $config['tabela_inss'] : '';
$tabelaCarregada = $inss->read($tabelaNome); 
$tabelaIrpfNome = isset($config['tabela_irpf']) ? $config['tabela_irpf'] : '';
$tabelaIrpfCarregada = $irpf->read($tabelaIrpfNome); 
$tabelaIrpfPlrNome = isset($config['tabela_irpf_plr']) ? $config['tabela_irpf_plr'] : '';
$tabelaIrpfPlrCarregada = $irpfPlr->read($tabelaIrpfPlrNome); 

function getFromArray($var, $index, $default = null) {
    return is_array($var) && $index != null && isset($var[$index]) ? $var[$index] : $default;
}

function get($var, $default = null) {
    return $var != null ? $var : $default;
}
