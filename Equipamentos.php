<?php

class Armas
{
    public $nome;
    public $dano_extra;
    public function __construct($nome, $dano_extra)
    {
        $this->nome = $nome;
        $this->dano_extra = $dano_extra;
    }
}

class ArmasdeFogo extends Armas
{

    public $tipo;
    public $dano_base;
    public $ROF;
    public $recarregamento;
    public $capacidade;
    public $municao;
    public $tax_cur;
    public $tax_med;
    public $tax_lon;
    public $hab_ad;

    public function __construct($nome, $tipo, $dano_base, $dano_extra, $ROF, $recarregamento, $capacidade, $municao, $tax_cur, $tax_med, $tax_lon, $hab_ad)
    {
        $this->nome = $nome;
        $this->tipo = $tipo;
        $this->dano_base = $dano_base;
        $this->dano_extra = $dano_extra;
        $this->ROF = $ROF;
        $this->recarregamento = $recarregamento;
        $this->capacidade = $capacidade;
        $this->municao = $municao;
        $this->tax_cur = $tax_cur;
        $this->tax_med = $tax_med;
        $this->tax_lon = $tax_lon;
        $this->hab_ad = $hab_ad;
    }
}

class ArmasArremessáveis extends Armas
{

    public $dano_base;

    public function __construct($nome, $dano_base, $dano_extra)
    {
        $this->nome = $nome;
        $this->dano_base = $dano_base;
        $this->dano_extra = $dano_extra;
    }
}

class Armadura
{
public $res_ca;
public $res_to;
public $res_pd;
public $res_pe;
public $res_bd;
public $res_be;
public $dur_ca;
public $dur_to;
public $dur_mem;
public function __construct($res_to, $res_mem, $res_ca = 0)
{
    $this->res_ca = $res_ca;
    $this->res_to = $res_to;
    $this->res_pd = $res_mem;
    $this->res_pe = $res_mem;
    $this->res_bd = $res_mem;
    $this->res_be = $res_mem;

    $this->dur_ca = $res_ca * 2;
    $this->dur_to = $res_to * 2;
    $this->dur_mem = $res_mem * 2;
}
}

class ArmaduraBoss extends Armadura
{
public function __construct($res_to, $res_mem, $res_ca = 0)
{
    $this->res_ca = $res_ca;
    $this->res_to = $res_to;
    $this->res_pd = $res_mem;
    $this->res_pe = $res_mem;
    $this->res_bd = $res_mem;
    $this->res_be = $res_mem;

    $this->dur_ca = $res_ca;
    $this->dur_to = $res_to;
    $this->dur_mem = $res_mem;
}
}

// armas //

// Padrão //

$soco = get_object_vars(new Armas('soco', 0));

// Marko Sobyanin //

$bulldog =  get_object_vars(new ArmasdeFogo('bulldog', 'tax_al', 22, '3d6', 9, 3, 3, '.5.45mm', 0.7, 0.8, 0.5, 0));
$ashot =  get_object_vars(new ArmasdeFogo('ashot', 'tax_pist', 42, '1d12 + 1d8', 1, 1, 1, '.12mm', 0.9, 0.8, 0.5, 10));
$shambler =  get_object_vars(new ArmasdeFogo('shambler', 'tax_esco', 51, '2d12', 3, 2, 2, '.12mm', 0.8, 0.6, 0.4, 0));
$bowie = get_object_vars(new Armas('bowie', '3d8'));

// Pietro Cortazo //

$valve = get_object_vars(new ArmasdeFogo('valve', 'tax_rp', 62, '1d20 + 2d12', 3, 3, 3, '.7.62mm', 0.2, 0.8, 1, 18));
$vsv = get_object_vars(new ArmasdeFogo('vsv', 'tax_ra', 20, '3d6', 7, 3, 3, '.5.45mm', 0.6, 0.8, 1, 31));
$stallion_pi = get_object_vars(new ArmasdeFogo('stallion', 'tax_pist', 24, '2d6 + 1d4', 6, 2, 2, '.44mm', 0.5, 0.7, 0.8, 10));
$karambits = get_object_vars(new Armas('karambits', '2d10 + 2d6'));

// Gangster Kalash //

$kalash =  get_object_vars(new ArmasdeFogo('kalash', 'tax_ra', 27, '4d6', 7, 4, 4, '.5.45mm', 0.7, 0.6, 0.4, 7));
$revolver =  get_object_vars(new ArmasdeFogo('revolver', 'tax_pist', 34, '2d8', 3, 2, 2, '.44mm', 0.8, 0.6, 0.4, 8));
$nr40 =  get_object_vars(new Armas('nr40', '2d8'));

// Gangster Bastard //

$bastard = get_object_vars(new ArmasdeFogo('bastard', 'tax_al', 25, '2d6 + 2d4', 10, 3, 3, '.5.45mm', 0.7, 0.5, 0.3, 13));
$stallion = get_object_vars(new ArmasdeFogo('stallion', 'tax_pist', 24, '2d6 + 1d4', 6, 2, 2, '.44mm', 0.7, 0.7, 0.4, 3));
$stilleto = get_object_vars(new Armas('stilleto', '2d8 + 1d6'));

// Nosaile //

$garras =  get_object_vars(new Armas('garras', '1d10'));

// armaduras //

$hazard = get_object_vars(new Armadura(45, 20, 25));
$nazi = get_object_vars(new ArmaduraBoss(100, 60, 75));
$ultra = get_object_vars(new Armadura(75, 45, 60));
$heavy = get_object_vars(new Armadura(60, 30, 45));
$stealth = get_object_vars(new Armadura(30, 20));
$simples = get_object_vars(new Armadura(30, 15));
