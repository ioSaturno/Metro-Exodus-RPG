<?php
/* echo "Nome: Marko Sobyanin
História: Marko nasceu na Ucrânia e se mudou para Moscou pouco antes da guerra, viveu normalmente até antes das bombas caírem, sua família conseguiu descer para os túneis de metrô, porém na estação que entraram, Pushkinskaya, em poucos anos apareceu o movimento nazista, que os expulsaram de sua estação por não serem russos. Após, começaram a viver de forma instável, sendo caçados por bandidos.
	Para sobreviver seu pai virou um Stalker, procurava lixo da superfície para ganhar um dinheiro pelo que vendia, sua mãe não resistiu aos maus tratos dos bandidos que a prenderam e estupraram, sem mãe e com pai ausente Marko saiu da estação de Barrikadnaya e seguiu uma jornada procurando uma estação que o trouxesse paz, Hanza não foi muito convidativa, pois tinha os comunistas como seus inimigos, porém teve de passar bastante tempo por lá, era um soldado, mas que sempre ficava de guarda. Quando descobriu Polis se sentiu mais esperançoso, gastando todo seu dinheiro para chegar na estação, lá foi aceito e passou a proteger a estação e realizar missões de combate, chegando ao cargo de Tenente após alguns anos nas forças militares da organização.
Características Físicas: Ele tem o cabelo preto, um aspecto fisico forte, mas não muito por não ser grande, o rosto é robusto e tem poucas cicatrizes no rosto;
Nacionalidade: Ucraniano.
Personalidade: Apesar de militar, não é muito frio, mas aparenta não se importar em se relacionar com as pessoas, não gosta de piadas, mas também não consegue não rir delas. (Não faz piadas, mas sabe rir)
Habilidade Especial: Por conta de estar tanto tempo em Polis e em um cargo importante conhece muito sobre todo o metrô e acontecimentos recentes (+10 em testes de Educação sobre os acontecimentos e geografia do metrô);
Braço Dominante: Direito.
Cargo: Tenente das forças armadas de Polis (D20 no TC).
Classe: Monster Hunter.
Estação Caseira: Polis.
Facção: Polis.

";
*/
$classe_esco = 15;
$classe_ra = 10;
$cargo_idade = 5;

$fisico = 9;
$agilidade = 10;
$constituicao = 8;
$estatura = 8;
$precisao = 12;
$inteligencia = 9;
$educacao = 8;
$charme = 5;
$luta = round(($fisico + $agilidade)/2, 0, PHP_ROUND_HALF_UP);
$investigação = round(($inteligencia + $educacao)/2,0, PHP_ROUND_HALF_UP);
$furtividade = round(($agilidade - $estatura)*2, 0, PHP_ROUND_HALF_UP);
$forca = $fisico + $estatura;

$vida = 100;
$res_ca = ($constituicao)*2;
$res_to = ($constituicao)*2 + $forca + $estatura;
$res_be = ($constituicao)*2 + $estatura;
$res_bd = ($constituicao)*2 + $estatura;
$res_pe = ($constituicao)*2 + $estatura;
$res_pd = ($constituicao)*2 + $estatura;

$tempo_combate = 59;
$idade = round(($tempo_combate)/12 + $cargo_idade + $educacao + 12 + 9, 0, PHP_ROUND_HALF_DOWN);
$alcance_ar = $fisico + $estatura;
$sobrevivência = round(($fisico + $agilidade + $constituicao + $estatura + $precisao + $inteligencia + $educacao)/7, 0, PHP_ROUND_HALF_UP);

$vpa = round(($tempo_combate/2) + ($precisao * 2), 0, PHP_ROUND_HALF_UP);

$hab_pist = $vpa + 20;
$hab_al = $vpa + 20;
$hab_ra = $vpa + 20 + $classe_ra;
$hab_rp = $vpa;
$hab_esco = $vpa + 20 + $classe_esco;

$meses = ($tempo_combate % 12);

/* Pistola Ashot */

$taxa_cur_ashot = round(($hab_pist + 5 + 5) * (0.7 + 0.1 + 0.1), 0, PHP_ROUND_HALF_UP);
$taxa_med_ashot = round(($hab_pist + 5 + 5) * (0.5 + 0.1 + 0.2), 0, PHP_ROUND_HALF_UP);
$taxa_lon_ashot = round(($hab_pist + 5 + 5) * (0.1 + 0.1 + 0.3), 0, PHP_ROUND_HALF_UP);

/* Escopeta Shambler */

$taxa_cur_sham = round(($hab_esco) * (0.7 + 0.1), 0, PHP_ROUND_HALF_UP);
$taxa_med_sham = round(($hab_esco) * (0.6 + 0.1), 0, PHP_ROUND_HALF_UP);
$taxa_lon_sham = round(($hab_esco) * (0.3 + 0.1), 0, PHP_ROUND_HALF_UP);

/* Arma Leve BullDog */

$taxa_cur_bull = round(($hab_al + 3 + 3) * (0.6 + 0.2 - 0.1), 0, PHP_ROUND_HALF_UP);
$taxa_med_bull = round(($hab_al + 3 + 3) * (0.7 + 0.2 - 0.1), 0, PHP_ROUND_HALF_UP);
$taxa_lon_bull = round(($hab_al + 3 + 3) * (0.4 + 0.2 - 0.1), 0, PHP_ROUND_HALF_UP);

echo "Atributos:

Físico: $fisico
Agilidade: $agilidade
Constituição: $constituicao
Estatura: $estatura
Precisão: $precisao
Inteligência: $inteligencia
Educação: $educacao

Luta: $luta
Charme: $charme
Investigação: $investigação
Força: $forca
Furtividade: $furtividade metros
Alcance de Arremesso: $alcance_ar metros

Experiência Militar: $sobrevivência
Tempo em Combate: $tempo_combate
Idade: $idade anos e $meses meses

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

Ashot:

Dano Base: 32
ROF: 1
Dano Extra: 1d10
Dano às Partes: 12
Recarregamento: 1

Taxa de Acerto:
Curto Alcance: $taxa_cur_ashot
Médio Alcance: $taxa_med_ashot
Longo Alcance:$taxa_lon_ashot

Shambler:

Dano Base: 41
ROF: 3
Dano Extra: 2d10
Dano às Partes: 17
Recarregamento: 2

Taxa de Acerto:
Curto Alcance: $taxa_cur_sham
Médio Alcance: $taxa_med_sham
Longo Alcance:$taxa_lon_sham

Bulldog:

Dano Base: 18
ROF: 9
Dano Extra: 5d3
Dano às Partes: 3
Recarregamento: 3

Taxa de Acerto:
Curto Alcance: $taxa_cur_bull
Médio Alcance: $taxa_med_bull
Longo Alcance:$taxa_lon_bull
";