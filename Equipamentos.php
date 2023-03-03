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
    public function __construct($res_pd, $res_pe, $res_bd, $res_be, $res_to, $res_ca = 0)
    {
        $this->res_ca = $res_ca;
        $this->res_to = $res_to;
        $this->res_pd = $res_pd;
        $this->res_pe = $res_pe;
        $this->res_bd = $res_bd;
        $this->res_be = $res_be;

        $this->dur_ca = $res_ca * 2;
        $this->dur_to = $res_to * 2;
        $this->dur_mem = $res_pe * 2;
    }
}

class ArmaduraBoss extends Armadura
{
    public function __construct($res_pd, $res_pe, $res_bd, $res_be, $res_to, $res_ca = 0)
    {
        $this->res_ca = $res_ca;
        $this->res_to = $res_to;
        $this->res_pd = $res_pd;
        $this->res_pe = $res_pe;
        $this->res_bd = $res_bd;
        $this->res_be = $res_be;

        $this->dur_ca = $res_ca;
        $this->dur_to = $res_to;
        $this->dur_mem = $res_pd;
    }
}

// armas //

// Padrão //

$soco = get_object_vars(new Armas('Soco', 0));

// Marko Sobyanin //

$bulldog = get_object_vars(new ArmasdeFogo('Bulldog', 'tax_al', 22, '3d6', 9, 3, 3, '.5.45mm', 0.7, 0.8, 0.5, 0));
$ashot = get_object_vars(new ArmasdeFogo('Ashot', 'tax_pist', 42, '1d12 + 1d8', 1, 1, 1, '.12mm', 0.9, 0.8, 0.5, 10));
$shambler = get_object_vars(new ArmasdeFogo('Shambler', 'tax_esco', 51, '2d12', 3, 2, 2, '.12mm', 0.8, 0.6, 0.4, 0));
$bowie = get_object_vars(new Armas('Bowie', '3d8'));

// Pietro Cortazo //

$valve = get_object_vars(new ArmasdeFogo('Valve', 'tax_rp', 62, '3d10', 3, 3, 3, '.7.62mm', 0.2, 0.8, 1, 18));
$vsv = get_object_vars(new ArmasdeFogo('VSV', 'tax_ra', 20, '3d6', 7, 3, 3, '.5.45mm', 0.6, 0.8, 1, 31));
$stallion_pi = get_object_vars(new ArmasdeFogo('Stallion', 'tax_pist', 24, '2d6 + 1d4', 6, 2, 2, '.44mm', 0.5, 0.7, 0.8, 10));
$karambits = get_object_vars(new Armas('Karambits', '2d10 + 2d6'));

// Gangster Kalash //

$kalash = get_object_vars(new ArmasdeFogo('Kalash', 'tax_ra', 27, '4d6', 7, 4, 4, '.5.45mm', 0.7, 0.6, 0.4, 7));
$revolver = get_object_vars(new ArmasdeFogo('Revolver', 'tax_pist', 34, '2d8', 3, 2, 2, '.44mm', 0.8, 0.6, 0.4, 8));
$nr40 = get_object_vars(new Armas('NR40', '2d8'));

// Gangster Bastard //

$bastard = get_object_vars(new ArmasdeFogo('Bastard', 'tax_al', 25, '2d6 + 2d4', 10, 3, 3, '.5.45mm', 0.7, 0.5, 0.3, 13));
$stallion = get_object_vars(new ArmasdeFogo('Stallion', 'tax_pist', 24, '2d6 + 1d4', 6, 2, 2, '.44mm', 0.7, 0.7, 0.4, 3));
$stilleto = get_object_vars(new Armas('Stilleto', '2d8 + 1d6'));

// Nosaile //

$garras = get_object_vars(new Armas('garras', '1d10'));

// armaduras //

$hazard = get_object_vars(new Armadura(20, 20, 20, 20, 45, 25));
$nazi = get_object_vars(new ArmaduraBoss(60, 60, 60, 60, 100, 75));
$ultra = get_object_vars(new Armadura(45, 45, 45, 45, 75, 60));
$heavy = get_object_vars(new Armadura(30, 30, 30, 30, 50, 35));
$stealth = get_object_vars(new Armadura(20, 20, 20, 20, 30));
$simples = get_object_vars(new Armadura(15, 15, 15, 15, 30));