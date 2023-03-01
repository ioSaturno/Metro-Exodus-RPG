<?php

$cargo_al = 15;
$cargo_pist = 15;
$cargo_idade = 3;

$fisico = 3 + 4;
$agilidade = 4 + 3;
$constituicao = 6 + 1;
$estatura = 6;
$precisao = 8 + 4;
$inteligencia = 5;
$educacao = 4;
$luta = round(($fisico + $agilidade)/2, 0, PHP_ROUND_HALF_UP);

$forca = $fisico + $estatura;
$tempo_combate = 34;
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

$vpa = round(($tempo_combate/2) + ($precisao * 2), 0, PHP_ROUND_HALF_UP);

$hab_pist = $vpa + $cargo_pist;
$hab_al = $vpa + $cargo_al;
$hab_ra = $vpa;
$hab_rp = $vpa;
$hab_esco = $vpa;

$pior_combate = ($tempo_combate % 12);

/* Pistola Stallion */

$taxa_cur_sta = round(($hab_pist + 3) * (0.7 + 0.1), 0, PHP_ROUND_HALF_UP);
$taxa_med_sta = round(($hab_pist + 3) * (0.7 + 0.1), 0, PHP_ROUND_HALF_UP);
$taxa_lon_sta = round(($hab_pist + 3) * (0.5), 0, PHP_ROUND_HALF_UP);

/* Arma Leve Bastard */

$taxa_cur_bas = round(($hab_al + 7 + 3 + 3) * (0.6 + 0.1 + 0.1), 0, PHP_ROUND_HALF_UP);
$taxa_med_bas = round(($hab_al + 7 + 3 + 3) * (0.5 + 0.1 + 0.2 + 0.1), 0, PHP_ROUND_HALF_UP);
$taxa_lon_bas = round(($hab_al + 7 + 3 + 3) * (0.2 + 0.2 + 0.1), 0, PHP_ROUND_HALF_UP);

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

Stallion:

Dano Base: 24
ROF: 6
Dano Extra: 3d8
Dano às Partes: 3
Recarregamento: 2

Taxa de Acerto:
Curto Alcance: $taxa_cur_sta
Médio Alcance: $taxa_med_sta
Longo Alcance:$taxa_lon_sta

Bastard:

Dano Base: 22
ROF: 10
Dano Extra: 5d3
Dano às Partes: 3
Recarregamento: 3

Taxa de Acerto:
Curto Alcance: $taxa_cur_bas
Médio Alcance: $taxa_med_bas
Longo Alcance:$taxa_lon_bas
";