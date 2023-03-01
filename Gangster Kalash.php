<?php

$cargo_ra = 15;
$cargo_pist = 15;
$cargo_idade = 3.5;

$fisico = 8;
$agilidade = 8;
$constituicao = 6;
$estatura = 5;
$precisao = 10;
$inteligencia = 7;
$educacao = 3;

$luta = round(($fisico + $agilidade)/2, 0, PHP_ROUND_HALF_UP);
$forca = $fisico + $estatura;
$tempo_combate = 45;
$idade = round(($tempo_combate)/12 + $cargo_idade + $educacao + 12 + 2, 0, PHP_ROUND_HALF_DOWN);
$alcance_ar = $fisico + $estatura;
$sobrevivência = round(($fisico + $agilidade + $constituicao + $estatura + $precisao + $inteligencia + $educacao)/7, 0, PHP_ROUND_HALF_UP);

$vida = 100;
$res_ca = ($constituicao)*2;
$res_to = ($constituicao)*2 + $forca + $estatura;
$res_be = ($constituicao)*2 + $estatura;
$res_bd = ($constituicao)*2 + $estatura;
$res_pe = ($constituicao)*2 + $estatura;
$res_pd = ($constituicao)*2 + $estatura;

$vpa = round($tempo_combate/2 + ($precisao * 2), 0, PHP_ROUND_HALF_UP);

$hab_pist = $vpa + 20 + $cargo_pist;
$hab_al = $vpa + 20;
$hab_ra = $vpa + 20 + $cargo_ra;
$hab_rp = $vpa;
$hab_esco = $vpa + 20;

$pior_combate = ($tempo_combate % 12);

/* Pistola Revolver */

$taxa_cur_rev = round(($hab_pist + 3 + 3 + 2) * (0.6 + 0.1 + 0.1), 0, PHP_ROUND_HALF_UP);
$taxa_med_rev = round(($hab_pist + 3 + 3 + 2) * (0.5 + 0.1 - 0.1), 0, PHP_ROUND_HALF_UP);
$taxa_lon_rev = round(($hab_pist + 3 + 3 + 2) * (0.3 + 0.1 - 0.2), 0, PHP_ROUND_HALF_UP);

/* Rifle de Assalto Kalash */

$taxa_cur_ak74 = round(($hab_ra + 3 + 4) * (0.6 + 0.2), 0, PHP_ROUND_HALF_UP);
$taxa_med_ak74 = round(($hab_ra + 3 + 4) * (0.5 + 0.2), 0, PHP_ROUND_HALF_UP);
$taxa_lon_ak74 = round(($hab_ra + 3 + 4) * (0.2 + 0.2), 0, PHP_ROUND_HALF_UP);

echo "Atributos:

Físico: $fisico
Agilidade: $agilidade
Constituição: $constituicao
Estatura: $estatura
Precisão: $precisao
Inteligência: $inteligencia
Educação: $educacao

Luta: $luta
Força: $forca
Alcance de Arremesso: $alcance_ar metros

Experiência Militar: $sobrevivência
Tempo em Combate: $tempo_combate
Idade: $idade anos e $pior_combate meses

Vida: $vida

Resistências:

Cabeça: $res_ca
Torso: $res_to
Braço Esquerdo: $res_be
Braço Direito: $res_bd
Perna Esquerda: $res_pe
Perna Direita: $res_pd

Habilidade com Armas:

Valor Padrão de Acerto: $vpa
Pistolas: $hab_pist
Armas Leves: $hab_al
Rifles de Assalto: $hab_ra
Rifles de Precisão: $hab_rp
Escopetas: $hab_esco

Revolver:

Dano Base: 35
ROF: 3
Dano Extra: 2d10
Dano às Partes: 12
Recarregamento: 3

Taxa de Acerto:
Curto Alcance: $taxa_cur_rev
Médio Alcance: $taxa_med_rev
Longo Alcance:$taxa_lon_rev

AK-74:

Dano Base: 27
ROF: 7
Dano Extra: 4d6
Dano às Partes: 4
Recarregamento: 4

Taxa de Acerto:
Curto Alcance: $taxa_cur_ak74
Médio Alcance: $taxa_med_ak74
Longo Alcance:$taxa_lon_ak74
";