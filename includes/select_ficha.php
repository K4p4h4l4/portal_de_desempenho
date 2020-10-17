<?php
    require_once "./conexao.php";
    $output="";
    $output2="";
    if(isset($_GET['user_id'])){
        $user_id = $_GET['user_id'];
        $query = "select * from tb_usuarios where usuario_id = '{$user_id}'";
        $result = mysqli_query($db, $query);
        $row = mysqli_fetch_assoc($result);
        $categoria = $row['categoria'];
        if(($row['categoria']=="Técnico(a) Superior 2 ª Classe") || ($row['categoria']=="Técnico(a) Médio(a) 3 ª Classe") || ($row['categoria']=="Técnico(a) Médio(a) Principal de 1 ª Classe") || ($row['categoria']=="Técnico(a) Médio(a) Principal de 2 ª Classe") || ($row['categoria']=="Técnico(a) Médio(a) Principal de 3 ª Classe")){
            $output.='<hr>
            <h4>Competência profissional</h4>
            <br>
            <p>1. Para efeitos de avaliação serão tidos em conta os seguintes critérios, no que respeita à competência profissional?</p>
            
            <br>
            <ul>
            <li>04 - Trabalho de excelente qualidade (13 - 17)</li>
            <li>03 - Trabalho de boa qualidade. (6 - 12)</li>
            <li>02 - Trabalho de qualidade razoável. (2 - 5)</li>
            <li>01 - Trabalho de má qualidade. (0 - 1)</li>
            </ul>
            <br>
            <ul>
            <li><p>Escolha entre 0 á 17.</p></li>
            <li><input type="number" max="17" min="0" class="rb-tab-active" step="1" id="compt_prof" required ></li>
            </ul>
            <br>
            <br>
            
          <hr>
            <br><br>
            <h4>Dinamismo e Iniciativa</h4>
            <br>
            <p>2.	Para efeitos de avaliação serão tidos em conta os seguintes critérios, no que respeita ao seu dinamismo e iniciativa?</p>
            
            <br>
            <ul>
                <li>04 - Dinâmico e com iniciativa.(13 - 15)</li>
                <li>03 - Dinâmico só na execução.(7 - 12)</li>
                <li>02 - Diligente na execução.(2 - 6)</li>
                <li>01 - Pouco activo.(0 - 1)</li>
            </ul>
            <br>
            <ul>
            <li><p>Escolha entre 0 á 15.</p></li>
            <li><input type="number" max="15" min="0" class="rb-tab-active" step="1" id="din_ini" required ><li>
            </ul>
            <br>
            <br>
          <hr>
            <br><br>
            <h4>Cumprimento das tarefas</h4>
            <br>
            <p>3. Para efeitos de avaliação serão tidos em conta os seguintes critérios, no que concerne o cumprimento das tarefas?</p>
            
            <br>
            <ul>
                <li>04 - Participa Sempre.(13 - 17)</li>
                <li>03 - Participa maioria das vezes.(9 - 12)</li>
                <li>02 - Participa pouco.(2 - 8)</li>
                <li>01 - Não participa.(0 - 1)</li>
            </ul>
            <br>
            <ul>
            <li><p>Escolha entre 0 á 17.</p></li>
            <li><input type="number" max="17" min="0" class="rb-tab-active" step="1" id="cump_tarefa" required ></li>
            </ul>
            <br>
           <hr>
            <br><br>
            <h4>Relações humanas no trabalho</h4>
            <br>
            <p>4. Para efeitos de avaliação serão tidos em conta os seguintes critérios, no que concerne o seu relacionamento humano no trabalho?</p>
            
            <br>
            <ul>
                <li>04 - Excelentes relações de trabalho.(10 - 15)</li>
                <li>03 - Boas relações de trabalho.(7 - 9)</li>
                <li>02 - Dificuldades de relacionamento.(2 - 6)</li>
                <li>01 - Mau relacionamento.(0 - 1)</li>
            </ul>
            <br>
            <ul>
            <li><p>Escolha entre 0 á 15.</p></li>
            <li><input type="number" max="15" min="0" class="rb-tab-active" step="1" id="rel_hum_trab" required ><li>
            </ul>
            <br>
            <br>
            
            <hr>
            <br><br>
            <h4>Adapatação à função</h4>
            <br>
            <p>5.	Para efeitos de avaliação em ternos de Assiduidade e Pontualidade, aplicam-se os seguintes critérios de adapatação a função?</p>
            
            <br>
            <ul>
                <li>04 - Excelente adaptação.(13 - 16)</li>
                <li>03 - Adaptação razoável.(9 - 12)</li>
                <li>02 - Dificuldades de adapatação.(2 - 8)</li>
                <li>01 - Não distribui tarefas.(0 - 1)</li>
            </ul>
            <br>
            <ul>
            <li><p>Escolha entre 0 á 16.</p></li>
            <li><input type="number" max="16" min="0" class="rb-tab-active" step="1" id="adapt_func" required ></li>
            </ul>
            <br>
            <br>

          <hr>
            <br><br>
            <h4>Disciplina</h4>
            <br>
            <p>6. Para efeitos de avaliação em ternos de Disciplina, aplicam-se os seguintes critérios?</p>
            
            <br>
            <ul>
                <li>04 - Exemplar.(13 - 15)</li>
                <li>03 - Disciplinado.(10 - 12)</li>
                <li>02 - Ocasionalmente indisciplinado.(2 - 9)</li>
                <li>01 - Indisciplinado.(0 - 1)</li>
            </ul>
            <br>
            <ul>
            <li><p>Escolha entre 0 á 15.</p></li>
            <li><input type="number" max="15" min="0" class="rb-tab-active" step="1" id="disciplina" required ></li>
            </ul>
            <br>
            <br>
          
          <hr>
            <br><br>
            <h4>Uso correcto dos equipamentos</h4>
            <br>
            <p>7. Faz o uso correcto dos equipamentos?</p>
            
            <br>
            <ul>
                <li>04 - Usa totalmente os meios e zela pela manutenção.(13 - 17)</li>
                <li>03 - Usa bem os meios e não permite danificação.(10 - 12)</li>
                <li>02 - Usa mal os meios.(2 - 9)</li>
                <li>01 - Usa mal os meios e danifica-os(0 - 1).</li>
            </ul>
            <br>
            <ul>
            <li><p>Escolha entre 0 á 17.</p></li>
            <li><input type="number" max="17" min="0" class="rb-tab-active" step="1" id="uso_correct_equip" required ></li>
            </ul>
            <br>
            <br>
            
          
          <hr>
            <br><br>
            <h4>Apresentação e compostura</h4>
            <br>
            <p>8. Para efeitos de avaliação em ternos de Apresentação e Compostura, aplicam-se os seguintes critérios?</p>
            
            <br>
            <ul>
                <li>04 - Porte impecável.(8 - 10)</li>
                <li>03 - Bom porte.(4 - 7)</li>
                <li>02 - Pouca Compostura.(2 - 3)</li>
                <li>01 - Desleixado.(0 - 1)</li>
            </ul>
            <br>
            <ul>
            <li><p>Escolha entre 0 á 10.</p></li>
            <li><input type="number" max="10" min="0" class="rb-tab-active" step="1" id="apr_comp" required ></li>
            </ul>
            <br>
            <br>
            
          
          <hr>
            <br><br>
            <h4>Presença nos Briefings matinais</h4>
            <br>
            <p>9. Para efeitos de avaliação da sua Presença nos Briefings matinais, aplicam-se os seguintes critérios de avaliação?</p>
            
            <br>
            <ul>
                <li>04 - Assíduo.(8 - 10)</li>
                <li>03 - Raramente falta.(4 - 7)</li>
                <li>02 - Falta algumas vezes.(2 - 3)</li>
                <li>01 - Não aparece.(0 - 1)</li>
            </ul>
            <br>
            <ul>
            <li><p>Escolha entre 0 á 10.</p></li>
            <li><input type="number" max="10" min="0" class="rb-tab-active" step="1" id="rm" required ></li>
            </ul>
            <br>
            <br>
          
          <hr>
            <br><br>
            <h4>Participação nas Reunões Operacionais</h4>
            <br>
            <p>10. Para efeitos de avaliação da sua Participação nas Reunões Operacionais aplicam-se os seguintes critérios de avaliação?</p>
            
            <br>
            <ul>
                <li>04 - Assíduo.(8 - 10)</li>
                <li>03 - Raramente falta.(4 - 7)</li>
                <li>02 - Falta algumas vezes.(2 - 3)</li>
                <li>01 - Não aparece.(0 - 1)</li>
            </ul>
            <br>
            <ul>
            <li><p>Escolha entre 0 á 10.</p></li>
            <li><input type="number" max="10" min="0" class="rb-tab-active" step="1" id="ro" required ></li>
            </ul>
            <br>
            <br>
          
          <hr>
            <br><br>
            <h4>Apreciação Geral</h4>
            <br>
            <p>Apreciação geral salientando se há ou não adaptação à função, quais os pontos fortes e fracos e quais os meios de aperfeiçoamento adequados:</p>
            
            <div class="obs">
                <div class="obs__box">
                    <textarea name="" id="obs" cols="10" rows="10" class="obs__textarea"></textarea>
                </div>
            </div>'; 
            echo $output;
        }elseif($row['categoria'] == 'Auxiliar Administrativo(a)'){
            $output .='<hr>
            <h4>Competência profissional</h4>
            <br>
            <p>1. Para efeitos de avaliação serão tidos em conta os seguintes critérios, no que respeita à assiduidade?</p>
            <br>
            <ul>
            <li>04 - Trabalho de excelente qualidade (13 - 17)</li>
            <li>03 - Trabalho de boa qualidade. (6 - 12)</li>
            <li>02 - Trablho de qualidade razoável. (2 - 5)</li>
            <li>01 - Trabalho de má qualidade. (0 - 1)</li>
            </ul>
            <br>
            <ul>
            <li><p>Escolha entre 0 á 17.</p></li>
            <li><input type="number" max="17" min="0" class="rb-tab-active" step="1" id="compt_prof" required ></li>
            </ul>
            <br>
            <br>
    
          <hr>
            <br><br>
            <h4>Cumprimento das tarefas</h4>
            <br>
            <p>2. Para efeitos de avaliação serão tidos em conta os seguintes critérios, no que concerne o cumprimento das tarefas?</p>
            <br>
            <ul>
                <li>04 - Participa Sempre.(13 - 17)</li>
                <li>03 - Participa maioria das vezes.(9 - 12)</li>
                <li>02 - Participa pouco.(2 - 8)</li>
                <li>01 - Não participa.(0 - 1)</li>
            </ul>
            <br>
            <ul>
            <li><p>Escolha entre 0 á 17.</p></li>
            <li><input type="number" max="17" min="0" class="rb-tab-active" step="1" id="cump_tarefa" required ></li>
            </ul>
            <br>
            <br>
           <hr>
            <br><br>
            <h4>Relações humanas no trabalho</h4>
            <br>
            <p>3. Para efeitos de avaliação serão tidos em conta os seguintes critérios, no que concerne o seu relacionamento humano no trabalho?</p>
            <br>
            <ul>
                <li>04 - Excelentes relações de trabalho.(10 - 15)</li>
                <li>03 - Boas relações de trabalho.(7 - 9)</li>
                <li>02 - Dificuldades de relacionamento.(2 - 6)</li>
                <li>01 - Mau relacionamento.(0 - 1)</li>
            </ul>
            <br>
            <ul>
            <li><p>Escolha entre 0 á 15.</p></li>
            <li><input type="number" max="15" min="0" class="rb-tab-active" step="1" id="rel_hum_trab" required ><li>
            </ul>
            <br>
            <br>
            
            <hr>
            <br><br>
            <h4>Adapatação à função</h4>
            <br>
            <p>4.	Para efeitos de avaliação em ternos de Assiduidade e Pontualidade, aplicam-se os seguintes critérios de adapatação a função?</p>
            <br>
            <ul>
                <li>04 - Excelente adaptação.(13 - 16)</li>
                <li>03 - Adaptação razoável.(9 - 12)</li>
                <li>02 - Dificuldades de adapatação.(2 - 8)</li>
                <li>01 - Não distribui tarefas.(0 - 1)</li>
            </ul>
            <br>
            <ul>
            <li><p>Escolha entre 0 á 16.</p></li>
            <li><input type="number" max="16" min="0" class="rb-tab-active" step="1" id="adapt_func" required ></li>
            </ul>
            <br>
            <br>
          
          <hr>
            <br><br>
            <h4>Uso correcto dos equipamentos</h4>
            <br>
            <p>5. Faz o uso correcto dos equipamentos?</p>
            <br>
            <ul>
                <li>04 - Usa totalmente os meios e zela pela manutenção.(13 - 17)</li>
                <li>03 - Usa bem os meios e não permite danificação.(10 - 12)</li>
                <li>02 - Usa mal os meios.(2 - 9)</li>
                <li>01 - Usa mal os meios e danifica-os(0 - 1).</li>
            </ul>
            <br>
            <ul>
            <li><p>Escolha entre 0 á 17.</p></li>
            <li><input type="number" max="17" min="0" class="rb-tab-active" step="1" id="uso_correct_equip" required ></li>
            </ul>
            <br>
            <br>
          
          <hr>
            <br><br>
            <h4>Presença nos Briefings matinais</h4>
            <br>
            <p>6. Para efeitos de avaliação da sua Presença nos Briefings matinais, aplicam-se os seguintes critérios de avaliação?</p>
            <br>
            <ul>
                <li>04 - Assíduo.(8 - 10)</li>
                <li>03 - Raramente falta.(4 - 7)</li>
                <li>02 - Falta algumas vezes.(2 - 3)</li>
                <li>01 - Não aparece.(0 - 1)</li>
            </ul>
            <br>
            <ul>
            <li><p>Escolha entre 0 á 10.</p></li>
            <li><input type="number" max="10" min="0" class="rb-tab-active" step="1" id="rm" required ></li>
            </ul>
            <br>
            <br>
          
          <hr>
            <br><br>
            <h4>Participação nas Reunões Operacionais</h4>
            <br>
            <p>7. Para efeitos de avaliação da sua Participação nas Reunões Operacionais aplicam-se os seguintes critérios de avaliação?</p>
            <br>
            <ul>
                <li>04 - Assíduo.(8 - 10)</li>
                <li>03 - Raramente falta.(4 - 7)</li>
                <li>02 - Falta algumas vezes.(2 - 3)</li>
                <li>01 - Não aparece.(0 - 1)</li>
            </ul>
            <br>
            <ul>
            <li><p>Escolha entre 0 á 10.</p></li>
            <li><input type="number" max="10" min="0" class="rb-tab-active" step="1" id="ro" required ></li>
            </ul>
            <br>
            <br>
          
          <hr>
            <br><br>
            <h4>Apreciação Geral</h4>
            <br>
            <p>Apreciação geral salientando se há ou não adaptação à função, quais os pontos fortes e fracos e quais os meios de aperfeiçoamento adequados:</p>
            
            <div class="obs">
                <div class="obs__box">
                    <textarea name="" id="obs" cols="10" rows="10" class="obs__textarea"></textarea>
                </div>
            </div>';
            echo $output;
        }
        
    }
    
?>
