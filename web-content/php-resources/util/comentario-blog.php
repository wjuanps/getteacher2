<?php
                                                    
$getComents = select("comentario_blog", "*", "WHERE id_blog = $post->id_blog", "ORDER BY data_comentario ASC");
$src = "";

if ($getComents):
    foreach ($getComents as $comentario):

        $getUsuario = select("usuarios u, comentario_blog c", "u.tipo_usuario, u.id_aluno, u.id_professor", "WHERE $comentario->id_comentario = c.id_comentario AND c.id_usuario IN (u.id_aluno, u.id_professor)");

        if ($getUsuario) {
            foreach ($getUsuario as $usuario) {
                $tipo_usuario = $usuario->tipo_usuario;
            } 

            if ($tipo_usuario == "Aluno") {
                $getInfos = select("aluno", "nome_aluno AS nome, foto_perfil", "WHERE id_aluno = $usuario->id_aluno");
                if ($getInfos) {
                    foreach ($getInfos as $info) {
                        $nome = $info->nome;
                        $foto = $info->foto_perfil;
                    }
                }

                $src = "../area-restrita/aluno/imagens/perfil/";

            } else if ($tipo_usuario == "Professor") {
                $getInfos = select("professor", "id_professor, nome_professor AS nome, foto_perfil", "WHERE id_professor = $usuario->id_professor");
                if ($getInfos) {
                    foreach ($getInfos as $info) {
                        $nome = $info->nome;
                        $foto = $info->foto_perfil;
                        $id = $info->id_professor;
                    }
                }

                $src = "../area-restrita/professor/imagens/perfil/";
            }
        }
        ?>
        <div style="text-align: left;" class='box-footer box-comments'>
            <div class="row-fluid">
                <div class='box-comment span12'>
                <!-- User image -->
                    <div class="span2">
                        <img class='usr2' src='<?php echo $src.$foto; ?>' alt='user image'>
                    </div>
                    <div class="span11" style="margin-left: -6%;">
                        <div class='comment-text'>
                            <span class="username">
                                <?php
                                    if ($tipo_usuario == "Professor") {
                                        echo "<a href='perfil-professor.php?professor=$id#banner'>".utf8_encode($nome)."</a>";
                                    } else {
                                        echo utf8_encode($nome); 
                                    }
                                ?>
                                <span class='text-muted pull-right'><?php echo date("d/m/Y H:i", strtotime($comentario->data_comentario)); ?></span>
                            </span><!-- /.username -->
                            <?php echo utf8_encode($comentario->comentario); ?>
                        </div><!-- /.comment-text -->
                    </div>
                </div>
            </div><!-- /.box-comment -->

        </div><!-- /.box-footer -->
    <?php endforeach; ?>
<?php else: ?>
    <div style="text-align: left;" class='box-footer box-comments'>
        <div class='box-comment span12'>
            <div class='comment-text'>
                <span class="text-light-blue c">Esse post ainda não foi comentado, seja o primeiro a comenta-lo.</span>
            </div>
        </div>
    </div>
    <?php 
endif; 

