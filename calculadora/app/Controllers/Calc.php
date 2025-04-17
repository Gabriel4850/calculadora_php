<?php
//Define o namespace (espaço de nomes) onde o controller está localizado, padrão do CodeIgniter.
namespace App\Controllers;

// Importa a classe base Controller, que seu controller irá estender. Essa classe fornece métodos úteis, como acesso ao request e session.
use CodeIgniter\Controller;

//No CodeIgniter, cada controller é uma classe.
class Calc extends Controller
{
    public function calcular()
    {
        //Ativa o sistema de sessão do CodeIgniter, permitindo armazenar e recuperar variáveis entre requisições.
        $session = session();

        //Tenta obter o valor atual do visor da calculadora a partir da sessão. Se ainda não existir (primeira vez), usa uma string vazia como padrão.
        //?? verifica apenas se o valor à esquerda é null. Se não for null, retorna o valor à esquerda. Se for null, retorna o valor à direita

        $visor = $session->get('visor') ?? '';
        $resultado = '0';

        // Limpa visor. Se o botão com name="limpar" for pressionado, o visor é limpo (resetado para string vazia).
        if ($this->request->getPost('limpar')) {
            $visor = '';
        }

        // Se algum botão de número (name="num") for pressionado, ele é adicionado ao final do conteúdo atual do visor (concatenação).
        //getPost('num') vai retornar: "0", "1", "2"... se um botão for clicado. Null se nenhum botão de número foi pressionado
        //!== null garante que até mesmo o "0" seja aceito
        $num = $this->request->getPost('num');
        if ($num !== null) {
            $visor .= $num;
        }

        // Se algum botão de operação (name="operacao", como +, -, *, /) for pressionado, ele também é adicionado ao visor, com espaços para melhorar a visualização.
        if ($op = $this->request->getPost('operacao')) {
            $visor .= ' ' . $op . ' ';
        }

        // Quando o botão = é clicado (name="calcular")
        // if ($this->request->getPost('calcular')) {
        //     try {
        //         // eval executa a string como código PHP. Exemplo: se o visor for 2 + 3 * 4, ele transforma isso em código real e calcula.
        //         eval('$resultado = ' . $visor . ';');
        //         //mostra o resultado no visor
        //         $visor = $resultado;

        //         //se houver erro
        //     } catch (\Throwable $e) {
        //         $visor = 'Operação inválida';
        //     }
        // }

        if ($this->request->getPost('calcular')) {
            try {
                eval('$resultado = ' . $visor . ';');
                $visor = $resultado;
        
                // Armazena no histórico
                $historico = $session->get('historico') ?? [];
                $historico[] = $session->get('visor') . ' = ' . $resultado;
                $session->set('historico', $historico);
        
            } catch (\Throwable $e) {
                $visor = 'Erro';
            }
        }
        
        if ($this->request->getPost('historico')) {
            $historico = $session->get('historico') ?? [];
            // Junta o histórico em uma string 
             $textoHistorico = implode("\n", array_slice($historico, -3)); // Mostra os últimos 3

            // Atualiza o visor com o histórico
            $visor = $textoHistorico;

            // Atualiza a sessão com o novo visor
            $session->set('visor', $visor);

            return view('calc', [
                'valor_visor' => $visor
            ]);
        }

        // Salva o visor na sessão para manter o estado
        $session->set('visor', $visor);

        // Passa o visor para a view
        return view('calc', ['valor_visor' => $visor]);

        
    }

    //Este método é chamado quando você acessa o site pela primeira vez (sem enviar POST).
    //Ele apenas mostra a view calc.php, com o visor sendo recuperado da sessão ou vazio se não tiver valor ainda.
    public function index()
    {
        $session = session();
        return view('calc', ['valor_visor' => $session->get('visor') ?? '']);
    }
}

