<?php

include('personagens.php');

function filtraracao($acao_sel)
{
    global $personagem;

    return array_filter($personagem['acoes'], fn($acao) => $acao == $acao_sel);
}

function Dano($dano_base, $dano_extra, $armadura)
{
    global $personagem;

    $dano = (($dano_base + $dano_extra) > $armadura) ? ($dano_base + $dano_extra) - $armadura : 0;
    return $dano;
}

function taxadeacerto($tax_cur, $tax_med, $tax_lon, $hab_per, $hab_arma)
{
    $hab = $hab_per + $hab_arma;

    $taxas = [
        'Taxa Curta' => round($hab * $tax_cur, 0, PHP_ROUND_HALF_UP),
        'Taxa Média' => round($hab * $tax_med, 0, PHP_ROUND_HALF_UP),
        'Taxa Longa' => round($hab * $tax_lon, 0, PHP_ROUND_HALF_UP)
    ];

    return $taxas;
}

function recuperacao($vida, $res_mem, $res_to, $res_ca)
{
    $vidas = [
        'vida' => ($vida),
        (round($res_mem / 2, 0, PHP_ROUND_HALF_UP)),
        (round($res_mem / 2, 0, PHP_ROUND_HALF_UP)),
        (round($res_mem / 2, 0, PHP_ROUND_HALF_UP)),
        (round($res_mem / 2, 0, PHP_ROUND_HALF_UP)),
        (round($res_to / 2, 0, PHP_ROUND_HALF_UP)),
        (round($res_ca / 2, 0, PHP_ROUND_HALF_UP)),
        'res_ca' => -($res_ca),
        'res_to' => -($res_to),
        'res_pd' => -($res_mem),
        'res_pe' => -($res_mem),
        'res_bd' => -($res_mem),
        'res_be' => -($res_mem)
    ];

    return $vidas;
}

$combatendo = true;

$partes = [
    'Não acertou',
    ['Perna Direita', 'res_pd'],
    ['Perna Esquerda', 'res_pe'],
    ['Braço Direito', 'res_bd'],
    ['Braço Esquerdo', 'res_be'],
    ['Torso', 'res_to'],
    ['Cabeça', 'res_ca'],
];

$contador_sequencia = 0;

$sequencia = [];

$personagens = [
    $gang_k['nome_sel'] => [
        $gang_k,
        'status' => 'normal',
        'arma_sel' => 3,
        'mutador' => ['', '', ''],
        'contador_status' => 2,
        'contador_queimando' => 2
    ],
    $marko['nome_sel'] => [
        $marko,
        'status' => 'normal',
        'arma_sel' => 3,
        'mutador' => ['', '', ''],
        'contador_status' => 2,
        'contador_queimando' => 2
    ],
    $gang_k2['nome_sel'] => [
        $gang_k2,
        'status' => 'normal',
        'arma_sel' => 3,
        'mutador' => ['', '', ''],
        'contador_status' => 2,
        'contador_queimando' => 2
    ],
    $gang_b['nome_sel'] => [
        $gang_b,
        'status' => 'normal',
        'arma_sel' => 3,
        'mutador' => ['', '', ''],
        'contador_status' => 2,
        'contador_queimando' => 2
    ],
    $pietro['nome_sel'] => [
        $pietro,
        'status' => 'normal',
        'arma_sel' => 3,
        'mutador' => ['', '', ''],
        'contador_status' => 2,
        'contador_queimando' => 2
    ],
    'cancelar' => null,
];

$vidas_or = [
    $marko['nome_sel'] => recuperacao($marko['vidas']['vida'], $marko['vidas']['res_pd'], $marko['vidas']['res_to'], $marko['vidas']['res_ca']),
    $gang_k['nome_sel'] => recuperacao($gang_k['vidas']['vida'], $gang_k['vidas']['res_pd'], $gang_k['vidas']['res_to'], $gang_k['vidas']['res_ca']),
    $gang_k2['nome_sel'] => recuperacao($gang_k2['vidas']['vida'], $gang_k2['vidas']['res_pd'], $gang_k2['vidas']['res_to'], $gang_k2['vidas']['res_ca']),
    $gang_b['nome_sel'] => recuperacao($gang_b['vidas']['vida'], $gang_b['vidas']['res_pd'], $gang_b['vidas']['res_to'], $gang_b['vidas']['res_ca']),
    $pietro['nome_sel'] => recuperacao($pietro['vidas']['vida'], $pietro['vidas']['res_pd'], $pietro['vidas']['res_to'], $pietro['vidas']['res_ca'])
];

// começo do sistema //

do {
    // pergunta se o combate ainda está em andamento //
    if ($contador_sequencia == 0 && $sequencia != null) {
        do {
            $combate_sel = strtolower(readline('Os Personagens ainda estão em combate? '));
        } while ($combate_sel != 's' && $combate_sel != 'n');

        $combatendo = ($combate_sel == 's') ? true : false;
    }

    // verificar se há uma ordem definida //
    if ($sequencia == null) {
        do {
            $sequencia_pronta = readline('A ordem de rodadas está pronta? ');

            if ($sequencia_pronta != 's') {
                do {
                    $personagem_sel = readline('Escreva o nome dos personagens na ordem dos turnos: ');
                } while (array_key_exists($personagem_sel, $personagens) == false);

                if ($personagem_sel != 'cancelar') {
                    array_push($sequencia, $personagem_sel);
                }

                print_r($sequencia);
            }
        } while ($sequencia_pronta != 's');
    } else {

        // perguntar ao usuário se ele deseja seguir a ordem e informá-lo quem agirá caso siga //
        echo PHP_EOL . 'O Personagem a agir será: ' . $sequencia[$contador_sequencia] . ', se você seguí-la.' . PHP_EOL;

        do {
            $sequencia_sel = strtolower(readline('A sequência será seguida? '));
        } while ($sequencia_sel != 's' && $sequencia_sel != 'n');

        $sequencia_sel = ($sequencia_sel == 's') ? true : false;

        if ($sequencia_sel == false) /* significa que a ordem não será seguido, ou seja, deve-se informar quem agirá esse momento */{

            // filtrar personagem que vai agir //
            do {
                $personagem_sel = readline('Qual personagem vai agir? ');
            } while (array_key_exists($personagem_sel, $personagens) == false);

        } else {
            $personagem_sel = $sequencia[$contador_sequencia];
        }

        $personagem = $personagens[$personagem_sel];

        print_r($personagem);

        // comparando o status do personagem //
        if ($personagem['status'] == 'morto') {
            echo $personagem[0]['nome'] . ' está morto, não tem como agir.' . PHP_EOL . PHP_EOL;

        } else if ($personagem['status'] == 'morrendo') {
            echo 'O valor da constituição do personagem é: ' . ($personagem[0]['atributos']['constituicao']);
            echo PHP_EOL . 'Faça um teste de constituição para ver se consegue não morrer.' . PHP_EOL;
            echo PHP_EOL . 'Para conseguir o jogador deve rolar d20 e o resultador deve ser acima de: ' . (20 - $personagem[0]['atributos']['constituicao']) . PHP_EOL;

            do {
                $acerto_sel = strtolower(readline('Qual foi o resultado (crítico, sucesso ou fracasso)? '));
            } while ($acerto_sel != 's' && $acerto_sel != 'c' && $acerto_sel != 'f');

            if ($acerto_sel == 'c') {
                $personagens[$personagem_sel]['status'] = 'inconsciente';
                $personagem[$personagem_sel][0]['vidas']['vida'] = 1;
            }
            if ($acerto_sel == 's') {
                $personagens[$personagem_sel]['contador_status']--;
            } else if ($acerto_sel == 'n') {
                $personagens[$personagem_sel]['contador_status']++;
            }

            if ($personagens[$personagem_sel]['contador_status'] <= 0) {

                $personagens[$personagem_sel]['status'] = 'inconsciente';
                $personagens[$personagem_sel][0]['vidas']['vida'] = 1;
                echo $personagem[0]['nome'] . ' conseguiu sair do estado morrendo!';
            } else {
                echo PHP_EOL . 'O personagem tem: ' . (round(($personagem[0]['atributos']['constituicao']) / 3, 0, PHP_ROUND_HALF_UP) + 2) - $personagens[$personagem_sel]['contador_status'] . ' rodadas até morrer' . PHP_EOL . PHP_EOL;
            }

            if ($personagens[$personagem_sel]['contador_status'] == round(($personagem[0]['atributos']['constituicao']) / 3) + 2) {
                $personagem['status'] = 'morto';
            }

            echo PHP_EOL . 'O personagem está ' . $personagens[$personagem_sel]['status'] . '.' . PHP_EOL;

        } else if ($personagem['status'] == 'inconsciente') {
            echo 'O valor da constituição do personagem é: ' . ($personagem[0]['atributos']['constituicao']);
            echo PHP_EOL . 'Faça um teste de constituição para ver se consegue acordar.' . PHP_EOL;
            echo PHP_EOL . 'Para conseguir o jogador deve rolar d20 e o resultador deve ser acima de: ' . (20 - $personagem[0]['atributos']['constituicao']) . PHP_EOL . PHP_EOL;

            do {
                $acerto_sel = strtolower(readline('Qual foi o resultado (crítico, sucesso ou fracasso)? '));
            } while ($acerto_sel != 's' && $acerto_sel != 'c' && $acerto_sel != 'f');

            if ($acerto_sel == 'c') {
                $personagens[$personagem_sel]['contador_status'] = 0;
            } else if ($acerto_sel == 's') {
                $personagens[$personagem_sel]['contador_status']--;
            }

            if ($personagens[$personagem_sel]['contador_status'] <= 0) {

                $personagens[$personagem_sel]['status'] = 'normal';
                $personagens[$personagem_sel][0]['vidas']['res_ca'] = $vidas_or[$personagem_sel][5];
                echo $personagem[0]['nome'] . ' conseguiu ficar consciente!';
            } else {
                echo PHP_EOL . 'O personagem ainda está inconsciente.' . PHP_EOL . PHP_EOL;
            }

            echo PHP_EOL . 'O personagem está ' . $personagens[$personagem_sel]['status'] . '.' . PHP_EOL;

        } else {

            $personagem = $personagens[$personagem_sel][0];

            // print_r($personagem);

            // filtra a ação do personagem //
            do {
                $acao_sel = strtolower(readline('Qual será a ação? '));
            } while (count(filtraracao($acao_sel)) == 0);

            $acao = filtraracao($acao_sel);
            $key_acao = array_key_first($acao);
            $acao = $acao[$key_acao];

            // comparando a ação e tomando providências quantos a elas //

            if ($acao == 'atirar' || $acao == 'recarregar' || $acao == 'trocar arma') {

                // selecionando as armas //
                print_r($personagem['inventario']['armas']);

                if ($personagens[$personagem_sel]['arma_sel'] == 3) {
                    do {
                        $arma_sel = readline('Qual arma ele está usando? ');
                    } while (is_string($arma_sel) == true && $arma_sel < 0 || $arma_sel > 2);

                    $personagens[$personagem_sel]['arma_sel'] = $arma_sel;
                } else {
                    $arma_sel = $personagens[$personagem_sel]['arma_sel'];

                    $arma = $personagem['inventario']['armas'][$arma_sel];

                    print_r($arma) . PHP_EOL;

                    if ($acao == 'atirar') {
                        if ($arma['recarregamento'] > 0 && $personagem['inventario']['municoes'][$arma['municao']] >= $arma['ROF']) {

                            $taxas = taxadeacerto($arma['tax_cur'], $arma['tax_med'], $arma['tax_lon'], $personagem['tax_acerto'][$arma['tipo']], $arma['hab_ad']);
                            print_r($taxas);

                            do {
                                $acerto_sel = strtolower(readline('Ele acertou o tiro? '));
                            } while ($acerto_sel != 's' && $acerto_sel != 'n');

                            $acerto = ($acerto_sel == 's') ? true : false;
                            $personagem['inventario']['municoes'][$arma['municao']] -= $arma['ROF'];
                            $arma['recarregamento']--;

                            if ($acerto == false) {
                                echo $personagem['nome'] . ' errou um tiro de ' . $arma['nome'] . PHP_EOL . PHP_EOL;
                            } else {

                                do {
                                    $alvo_sel = strtolower(readline('Quem ele acertou? '));
                                } while (array_key_exists($personagem_sel, $personagens) == false);

                                $alvo_vida = $personagens[$alvo_sel][0];

                                print_r($alvo_vida);
                                print_r($partes);

                                do {
                                    $parte_sel = (readline('Em qual parte do corpo ele acertou? ' . PHP_EOL));

                                } while ($parte_sel > 6 && $parte_sel < 0 && is_string($arma_sel) == true);

                                echo $parte_sel . ': ' . $partes[$parte_sel][0] . PHP_EOL;
                                print_r(PHP_EOL . $arma['dano_extra'] . PHP_EOL . PHP_EOL);
                                $dano_extra = -1;

                                do {
                                    $dano_extra = ($parte_sel > 0) ? (readline('Quanto foi o dano extra? ')) : 0;
                                } while ($dano_extra < 0 && is_string($dano_extra) == true);

                                if ($parte_sel > 0) {
                                    $alvo_vida['vidas']['vida'] -= $dano = Dano($arma['dano_base'], $dano_extra, $alvo_vida['inventario']['armadura'][$partes[$parte_sel][1]]);
                                    $alvo_vida['vidas'][$partes[$parte_sel][1]] -= $dano_extra;
                                    $personagens[$alvo_sel][0] = $alvo_vida;
                                }

                                if ($personagens[$alvo_sel][0]['vidas']['res_ca'] < 0 && $personagens[$alvo_sel][0]['vidas']['res_ca'] > $vidas_or[$alvo_sel]['res_ca']) {
                                    $personagens[$alvo_sel]['status'] = 'inconsciente';
                                    $personagem[$alvo_sel]['contador_status'] = 2;
                                }
                                if ($personagens[$alvo_sel][0]['vidas']['vida'] <= 0) {
                                    $personagens[$alvo_sel]['status'] = 'morrendo';
                                    $personagem[$alvo_sel]['contador_status'] = 2;
                                }
                                if ($personagens[$alvo_sel][0]['vidas']['res_ca'] <= $vidas_or[$alvo_sel]['res_ca'] || $personagens[$alvo_sel][0]['vidas']['res_to'] <= $vidas_or[$alvo_sel]['res_to']) {
                                    $personagens[$alvo_sel]['status'] = 'morto';
                                }

                                echo 'vida do alvo: ' . json_encode($alvo_vida['vidas']['vida']) . PHP_EOL;
                                echo 'resistência da parte atingida: ' . json_encode($alvo_vida['vidas'][$partes[$parte_sel][1]]) . PHP_EOL . PHP_EOL;
                            }

                            echo 'munição restante de ' . $arma['municao'] . ': ' . json_encode($personagem['inventario']['municoes'][$arma['municao']]) . PHP_EOL;
                            echo 'rodadas até recarregar: ' . json_encode($arma['recarregamento']) . PHP_EOL;
                        } else {

                            if ($personagem['inventario']['municoes'][$arma['municao']] >= $arma['ROF']) {
                                do {
                                    $acao_sel = strtolower(readline('Ele não consegue atirar, qual será a ação? '));
                                } while (count(filtraracao($acao_sel)) == 0);

                                $acao = filtraracao($acao_sel);
                                $key_acao = array_key_first($acao);
                                $acao = $acao[$key_acao];
                                echo $personagem['nome'] . ' está sem munição no pente, então ele vai ' . $acao . ' essa rodada.' . PHP_EOL;
                            } else {
                                do {
                                    $acao_sel = strtolower(readline('Ele não tem munição para essa arma, qual será a ação? '));
                                } while (count(filtraracao($acao_sel)) == 0);

                                $acao = filtraracao($acao_sel);
                                $key_acao = array_key_first($acao);
                                $acao = $acao[$key_acao];

                                if ($acao == 'recarregar') {
                                    $acao = 'trocar arma';
                                }

                                echo $personagem['nome'] . ' está sem munição de ' . $arma['municao'] . ', então ele vai ' . $acao . ' essa rodada.' . PHP_EOL;
                            }
                        }
                    }

                    if ($acao == 'recarregar') {
                        $arma['recarregamento'] = $arma['capacidade'];
                        echo 'rodadas até recarregar: ' . json_encode($arma['recarregamento']) . PHP_EOL;
                    }

                    $personagem['inventario']['armas'][$arma_sel] = $arma;

                    if ($acao == 'trocar arma') {
                        do {
                            $arma_sel = readline('Qual arma ele está usando? ');
                        } while (is_string($arma_sel) == true && $arma_sel < 0 || $arma_sel > 2);
    
                        $personagens[$personagem_sel]['arma_sel'] = $arma_sel;
                    }
                }
            }

            if ($acao == 'curar') {

                do {
                    $alvo_sel = strtolower(readline('Quem ele vai curar? '));
                } while (array_key_exists($personagem_sel, $personagens) == false);

                $alvo_vida = $personagens[$alvo_sel][0]['vidas'];

                var_dump($alvo_vida);
                $alvo_vida['vida'] = $vidas_or[$alvo_sel]['vida'];

                foreach ($partes as $chave => $valor) {
                    if ($chave != 0) {
                        $valor = $partes[$chave][1];
                        if ($alvo_vida[$valor] < $vidas_or[$alvo_sel][$chave] && $alvo_vida[$valor] > $vidas_or[$valor]) {
                            $alvo_vida[$valor] = $vidas_or[$alvo_sel][$chave];
                        }
                    }
                }

                $personagem['inventario']['medkits'] -= 1;
                $personagens[$alvo_sel][0]['vidas'] = $alvo_vida;

                print_r($personagens[$alvo_sel][0]['vidas']);
                echo 'Vida atual: ' . $alvo_vida['vida'] . PHP_EOL;
                echo 'MedKits restantes: ' . $personagens[$alvo_sel][0]['inventario']['medkits'] . PHP_EOL;
            }

            if ($acao == 'corpo a corpo' || $acao == 'movimentação' || $acao == 'agarrar') {
                echo PHP_EOL . 'Faça um teste de agilidade para se movientar, o valor de agilidade do personagem é: ' . ($personagem['atributos']['agilidade']) . PHP_EOL;
                echo PHP_EOL . 'Para conseguir o jogador deve rolar d20 e o resultador deve ser acima de: ' . (20 - $personagem['atributos']['agilidade']) . PHP_EOL . PHP_EOL;


                if ($acao == 'corpo a corpo' || $acao == 'agarrar') {

                    $personagens[$personagem_sel]['arma_sel'] = 3;

                    do {
                        $alvo_sel = strtolower(readline('Quem ele vai enfrentar? '));
                    } while (is_string($alvo_sel) != true);

                    if ($alvo_sel != 'cancelar') {

                        $alvo = $personagens[$alvo_sel][0];

                        echo PHP_EOL . 'O Valor de Luta do ' . $personagem['nome'] . ' é: ' . $personagem['atributos']['luta'] . PHP_EOL;
                        echo PHP_EOL . 'Já o Valor de Luta do ' . $alvo['nome'] . ' está em: ' . $alvo['atributos']['luta'] . PHP_EOL . PHP_EOL;

                        if ($acao == 'corpo a corpo') {

                            echo PHP_EOL . 'A vida do personagem ' . $alvo_sel . ' está em: ' . $alvo['vidas']['vida'] . PHP_EOL . PHP_EOL;

                            do {
                                $acerto_sel = strtolower(readline('Ele ganhou o duelo corpo a corpo? '));
                            } while ($acerto_sel != 's' && $acerto_sel != 'n');

                            $acerto = ($acerto_sel == 's') ? true : false;

                            echo 'Dano Extra do Atacante, se ele acertar: ' . $personagem['inventario']['corpoacorpo']['dano_extra'] . PHP_EOL;
                            echo 'Dano Extra do alvo, se o atacante falhar: ' . $alvo['inventario']['corpoacorpo']['dano_extra'] . PHP_EOL . PHP_EOL;

                            $dano_extra = 5;

                            do
                                if ($acerto == true || $personagens[$alvo_sel]['arma_sel'] == 3) {
                                    $dano_extra = (readline('Quanto foi o dano extra? '));
                                } while ($dano_extra < 0 && is_string($dano_extra) == true);

                            if ($acerto == true) {
                                $alvo['vidas']['vida'] -= (($personagem['atributos']['forca'] + $dano_extra));
                                echo 'Vida do ' . $alvo['nome'] . ':' . json_encode($alvo['vidas']['vida']) . PHP_EOL;
                            } else {
                                $personagem['vidas']['vida'] -= ($alvo['atributos']['forca'] + $dano_extra);
                                echo 'Vida do ' . $personagem['nome'] . ':' . json_encode($personagem['vidas']['vida']) . PHP_EOL;
                            }

                            $personagens[$personagem_sel][0] = $personagem;
                            $personagens[$alvo_sel][0]['vidas'] = $alvo['vidas'];

                            if ($personagens[$alvo_sel][0]['vidas']['vida'] <= 0) {
                                $personagens[$alvo_sel]['status'] = 'morrendo';
                            }
                        } else {
                            echo $personagem['nome'] . ' não chegou no seu alvo.' . PHP_EOL . PHP_EOL;
                        }
                    }
                }
            }

            if ($acao == 'arremessar') {

            }

            $personagens[$personagem_sel][0]['inventario'] = $personagem['inventario'];
        }

        if ($sequencia_sel == true) {
            $contador_sequencia++;
        }

        if ($contador_sequencia == count(array_keys($sequencia))) {
            $contador_sequencia = 0;
        }
    }

} while ($combatendo == true);

if ($combatendo == false) {
    // insere os dados de todos os personagens no banco de dados //

    print_r($personagens);
}