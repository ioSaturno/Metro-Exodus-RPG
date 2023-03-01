<?php

include_once('equipamentos.php');

class PrecisãoPersonagem
{
    public $precisao;
    public $tempo_combate;
    public $vpa;
    public $hab_al;
    public $hab_esco;
    public $hab_pist;
    public $hab_ra;
    public $hab_rp;
    public $classe_al;
    public $classe_esco;
    public $classe_pist;
    public $classe_ra;
    public $classe_rp;
    public $tax_al;
    public $tax_esco;
    public $tax_pist;
    public $tax_ra;
    public $tax_rp;


    public function __construct($precisao, $tempo_combate, $classe_al, $classe_esco, $classe_pist, $classe_ra, $classe_rp, $hab_al, $hab_esco, $hab_pist, $hab_rp, $hab_ra)
    {
        // valores passados
        $this->precisao = $precisao;
        $this->tempo_combate = $tempo_combate;
        $this->hab_al = $hab_al;
        $this->hab_esco = $hab_esco;
        $this->hab_pist = $hab_pist;
        $this->hab_ra = $hab_ra;
        $this->hab_rp = $hab_rp;
        $this->classe_al = $classe_al;
        $this->classe_esco = $classe_esco;
        $this->classe_pist = $classe_pist;
        $this->classe_ra = $classe_ra;
        $this->classe_rp = $classe_rp;


        $this->vpa = round(($this->tempo_combate / 2) + ($this->precisao * 2), 0, PHP_ROUND_HALF_UP);

        $this->tax_al = $this->vpa + $this->classe_al + $this->hab_al;
        $this->tax_esco = $this->vpa + $this->classe_esco + $this->hab_esco;
        $this->tax_pist = $this->vpa + $this->classe_pist + $this->hab_pist;
        $this->tax_ra = $this->vpa + $this->classe_ra + $this->hab_ra;
        $this->tax_rp = $this->vpa + $this->classe_rp + $this->hab_rp;
    }
}

class Vidas
{
    public $fisico;
    public $constituicao;
    public $estatura;
    public $vida;
    public $forca;
    public $res_ca;
    public $res_to;
    public $res_be;
    public $res_bd;
    public $res_pe;
    public $res_pd;
    public $multiplicador;

    private function calcularResistencia()
    {

        $precisao = $this->constituicao * $this->multiplicador;

        return $precisao + $this->estatura;
    }

    public function __construct($fisico, $constituicao, $estatura, $vida, $multiplicador)
    {
        $this->fisico = $fisico;
        $this->constituicao = $constituicao;
        $this->estatura = $estatura;
        $this->forca = ($this->fisico + $this->estatura) * 2;
        $this->multiplicador = $multiplicador;

        $this->vida = $vida;
        $this->res_ca = $this->constituicao * $multiplicador;
        $this->res_to = $this->calcularResistencia() + $this->forca;
        $this->res_be = $this->calcularResistencia();
        $this->res_bd = $this->calcularResistencia();
        $this->res_pe = $this->calcularResistencia();
        $this->res_pd = $this->calcularResistencia();
    }
}

class AtributosPersonagem
{
    public $fisico;
    public $agilidade;
    public $constituicao;
    public $estatura;
    public $precisao;
    public $inteligencia;
    public $educacao;
    public $forca;
    public $sorte;
    public $percepcao;
    public $luta;
    public $alcance_arremesso;
    public $sobrevivencia;
    public $furtividade;

    private function calcularSobrevivencia()
    {
        $soma_atributos = array_sum([
            $this->fisico,
            $this->agilidade,
            $this->constituicao,
            $this->estatura,
            $this->precisao,
            $this->inteligencia,
            $this->educacao
        ]);

        return round($soma_atributos / 7, 0, PHP_ROUND_HALF_UP);
    }

    public function __construct($fisico, $agilidade, $constituicao, $estatura, $precisao, $inteligencia, $educacao, $sorte)
    {
        $this->fisico = $fisico;
        $this->agilidade = $agilidade;
        $this->constituicao = $constituicao;
        $this->estatura = $estatura;
        $this->precisao = $precisao;
        $this->inteligencia = $inteligencia;
        $this->educacao = $educacao;
        $this->sorte = $sorte;
        $this->forca = ($this->fisico + $this->estatura) * 2;
        $this->alcance_arremesso = ($this->fisico + $this->estatura) . 'm';
        $this->sobrevivencia = $this->calcularSobrevivencia();
        $this->luta = round(($this->fisico + $this->agilidade) / 2, 0, PHP_ROUND_HALF_UP);
        $this->percepcao = round(($this->inteligencia + $this->educacao) / 2, 0, PHP_ROUND_HALF_UP);
        $this->furtividade = round((($this->agilidade * 2) - $this->estatura), 0, PHP_ROUND_HALF_UP);
    }
}

class Inventario
{
    public $municoes;
    public $armas;
    public $corpoacorpo;
    public $armadura;
    public $medkits;
    public $granadas;
    public $molotovs;
    public $facasarremesso;
    public $primeirossocorros;

    public function __construct($municoes, $armas, $corpoacorpo, $armadura, $medkits = 0, $primeirossocorros = 0, $granadas = 0, $molotovs = 0, $facasarremesso = 0)
    {
        $this->municoes = $municoes;
        $this->armas = $armas;
        $this->corpoacorpo = $corpoacorpo;
        $this->armadura = $armadura;
        $this->medkits = $medkits;
        $this->primeirossocorros = $primeirossocorros;
        $this->granadas = $granadas;
        $this->molotovs = $molotovs;
        $this->facasarremesso = $facasarremesso;
    }
}
class Personagem
{
    public $nome_sel;
    public $idade;
    public $cargo;
    public $braco_dominante;
    public $faccao;

    public $tax_acerto;
    public $atributos;
    public $vidas;
    public $inventario;
    public $nome;
    public $acoes;
    public function __construct($nome, $nome_sel, $idade, $cargo, $braco_dominante, $faccao, $acoes, $tax_acerto, $atributos, $vidas, $inventario)
    {
        $this->nome = $nome;
        $this->nome_sel = $nome_sel;
        $this->idade = $idade;
        $this->cargo = $cargo;
        $this->braco_dominante = $braco_dominante;
        $this->faccao = $faccao;
        $this->acoes = $acoes;
        $this->tax_acerto = $tax_acerto;
        $this->atributos = $atributos;
        $this->vidas = $vidas;
        $this->inventario = $inventario;
    }
}

class Aliado extends Personagem
{
    public $sexo;
    public $nacionalidade;
    public $classe;
    public $habiliade_espacial;
    public $charme;
    public $nome_sel;
    public $nome;
    public $acoes;

    public function __construct($nome, $nome_sel, $idade, $sexo, $nacionalidade, $habiliade_espacial, $charme, $classe, $cargo, $braco_dominante, $faccao, $acoes, $tax_acerto, $atributos, $vidas, $inventario)
    {
        $this->nome = $nome;
        $this->nome_sel = $nome_sel;
        $this->sexo = $sexo;
        $this->nacionalidade = $nacionalidade;
        $this->habiliade_espacial = $habiliade_espacial;
        $this->charme = $charme;
        $this->idade = $idade;
        $this->classe = $classe;
        $this->cargo = $cargo;
        $this->braco_dominante = $braco_dominante;
        $this->faccao = $faccao;
        $this->acoes = $acoes;

        $this->tax_acerto = $tax_acerto;
        $this->atributos = $atributos;
        $this->vidas = $vidas;
        $this->inventario = $inventario;
    }
}

class Inimigo extends Personagem
{
}

class Mutante
{
    public $nome;
    public $fisico;
    public $agilidade;
    public $constituicao;
    public $estatura;
    public $precisao;
    public $forca;
    public $percepcao;
    public $inteligencia;
    public $educacao;
    public $luta;
    public $vida;
    public $res_ca;
    public $res_to;
    public $res_be;
    public $res_bd;
    public $res_pe;
    public $res_pd;
    public $multiplicador;
    public $acoes;

    private function calcularResistencia()
    {
        $precisao = $this->constituicao * $this->multiplicador;

        return $precisao + $this->estatura;
    }

    public function __construct($nome, $fisico, $agilidade, $constituicao, $estatura, $precisao, $inteligencia, $educacao, $vida, $multiplicador, $acoes)
    {
        // valores passados
        $this->nome = $nome;
        $this->fisico = $fisico;
        $this->agilidade = $agilidade;
        $this->constituicao = $constituicao;
        $this->estatura = $estatura;
        $this->precisao = $precisao;
        $this->inteligencia = $inteligencia;
        $this->educacao = $educacao;
        $this->vida = $vida;
        $this->multiplicador = $multiplicador;
        $this->acoes = $acoes;

        // valores calculos
        $this->forca = ($this->fisico + $this->estatura) * 2;

        $this->res_ca = $this->constituicao * $this->multiplicador;
        $this->res_to = $this->calcularResistencia() + $this->forca;
        $this->res_be = $this->calcularResistencia();
        $this->res_bd = $this->calcularResistencia();
        $this->res_pe = $this->calcularResistencia();
        $this->res_pd = $this->calcularResistencia();

        $this->luta = round(($this->fisico + $this->agilidade) / 2, 0, PHP_ROUND_HALF_UP);
        $this->percepcao = round(($this->inteligencia + $this->educacao) / 2, 0, PHP_ROUND_HALF_UP);
    }
}

// personagens //

$marko = get_object_vars(
    new Aliado(
        'Marko Sobyanin',
        'marko',
        38,
        'masculino',
        'ucraniano',
        '+5 em testes de educação em relação aos eventos no Metrô',
        5,
        'caçador de mutantes',
        'tenente',
        'direito',
        'polis',
        [
            'agarrar',
            'arremessar',
            'atirar',
            'corpo a corpo',
            'curar',
            'movimentação',
            'nada',
            'recarregar',
            'trocar arma',
        ],
        $precisão_marko = get_object_vars(new PrecisãoPersonagem(12, 59, 0, 15, 0, 10, 0, 20, 20, 20, 0, 20)),
        $atributos_marko = get_object_vars(new AtributosPersonagem(9, 10, 8, 8, 12, 9, 8, 5)),
        $vidas_marko = get_object_vars(new Vidas(9, 8, 8, 100, 2)),
        $inventario_marko = get_object_vars(new Inventario(['.5.45mm' => 50, '.44mm' => 46, '.12mm' => 40, '.50mm' => 4, '.7.62mm' => 0, 'flechas' => 17, 'cilindros' => 12], [$bulldog, $ashot, $shambler], $bowie, $hazard, 4, 0, 2, 1, 4))
    )
);

$pietro = get_object_vars(
    new Aliado(
        'Pietro Cortazo',
        'pietro',
        26,
        'masculino',
        'italiano',
        '+1d em ataques corpo a corpo',
        12,
        'atirador de precisão',
        'oficial',
        'direito',
        'hanza',
        [
            'agarrar',
            'arremessar',
            'atirar',
            'corpo a corpo',
            'curar',
            'movimentação',
            'nada',
            'recarregar',
            'trocar arma',
        ],
        $precisão_pietro = get_object_vars(new PrecisãoPersonagem(15, 73, 0, -20, 0, -10, 10, 20, 0, 20, 20, 20)),
        $atributos_pietro = get_object_vars(new AtributosPersonagem(9, 11, 10, 7, 15, 9, 6, 16)),
        $vidas_pietro = get_object_vars(new Vidas(9, 10, 7, 100, 2)),
        $inventario_pietro = get_object_vars(new Inventario(['.5.45mm' => 60, '.44mm' => 40, '.12mm' => 10, '.50mm' => 12, '.7.62mm' => 25, 'flechas' => 0, 'cilindros' => 0], [$valve, $vsv, $stallion_pi], $karambits, [45, 20, 45], 5, 1, 1, 0, 3))
    )
);

$gang_k = get_object_vars(
    new Inimigo(
        'Jorge',
        'gk',
        25,
        'Combatente',
        'direito',
        'Gangsters',
        [
            'agarrar',
            'arremessar',
            'atirar',
            'corpo a corpo',
            'curar',
            'movimentação',
            'nada',
            'recarregar',
            'trocar arma',
        ],
        $precisão_gk1 = get_object_vars(new PrecisãoPersonagem(10, 45, 0, 0, 15, 15, 0, 20, 20, 20, 0, 20)),
        $atributos_gk1 = get_object_vars(new AtributosPersonagem(8, 8, 6, 5, 10, 7, 3, 15)),
        $vidas_gk1 = get_object_vars(new Vidas(8, 6, 5, 100, 2)),
        $inventario_gk1 = get_object_vars(new Inventario(['.5.45mm' => 90, '.44mm' => 60, '.12mm' => 20], [$kalash, $revolver], $nr40, get_object_vars(new Armadura(45, 15, 25)), 2, 0, 1, 1, 0))
    )
);

$gang_k2 = get_object_vars(
    new Inimigo(
        'Firmino',
        'gk2',
        25,
        'Combatente',
        'direito',
        'Gangsters',
        [
            'agarrar',
            'arremessar',
            'atirar',
            'corpo a corpo',
            'curar',
            'movimentação',
            'nada',
            'recarregar',
            'trocar arma',
        ],
        $precisão_gk1 = get_object_vars(new PrecisãoPersonagem(10, 45, 0, 0, 15, 15, 0, 20, 20, 20, 0, 20)),
        $atributos_gk1 = get_object_vars(new AtributosPersonagem(8, 8, 6, 5, 10, 7, 3, 15)),
        $vidas_gk1 = get_object_vars(new Vidas(8, 6, 5, 100, 2)),
        $inventario_gk1 = get_object_vars(new Inventario(['.5.45mm' => 90, '.44mm' => 60, '.12mm' => 20], [$kalash, $revolver], $nr40, get_object_vars(new Armadura(45, 15, 25)), 2, 0, 1, 1, 0))
    )
);

$gang_b = get_object_vars(
    new Inimigo(
        'Claudio',
        'bastard',
        25,
        'Combatente',
        'direito',
        'Gangsters',
        [
            'agarrar',
            'arremessar',
            'atirar',
            'corpo a corpo',
            'curar',
            'movimentação',
            'nada',
            'recarregar',
            'trocar arma',
        ],
        $precisão_gb = get_object_vars(new PrecisãoPersonagem(12, 34, 15, 0, 15, 0, 0, 20, 0, 20, 0, 0)),
        $atributos_gb = get_object_vars(new AtributosPersonagem(7, 7, 7, 6, 12, 5, 4, 3)),
        $vidas_gb = get_object_vars(new Vidas(7, 7, 6, 100, 2)),
        $inventario_gb = get_object_vars(new Inventario(['.5.45mm' => 90, '.44mm' => 60, '.12mm' => 20], [$bastard, $stallion], $stilleto, $simples, 2, 0, 0, 2, 0)),
    )
);

// echo $gang_b['nome_sel'];
// print_r($gang_b['atributos']);
// print_r($gang_b['inventario']);
// echo $gang_k['nome_sel'];
// print_r($gang_k['atributos']);
// print_r($gang_k['inventario']);
// echo $marko['nome_sel'];
// print_r($marko['atributos']);
// print_r($marko['inventario']);
// echo $pietro['nome_sel'];
// print_r($pietro['atributos']);
// print_r($pietro['inventario']);

$nosaile = new Mutante(
    'nosaile',
    10,
    12,
    12,
    13,
    0,
    7,
    9,
    150,
    3,
    [
        'agarrar',
        'corpo a corpo',
        'movimentação',
        'nada',
    ],
);

// print_r($nosaile);