<?php
$url_json = 'https://gitlab.com/sasmira/swade-fr/-/raw/master/module/compendiums/swade-core-rules.swade-rules.json';
$json = file_get_contents($url_json);
$json_decoded = json_decode($json);
//echo '<pre>'; print_r($json_decoded);
if (isset($_POST) && !empty($_POST)) {
    //echo '<pre>'; print_r($_POST);

}
$id = -1;
if (isset($_GET['id']) && $_GET['id'] != '') {
    $id = (int) $_GET['id'];
}
?><!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style>
        .entry_wrapper {
        }
        .no_trans {
            background-color: #FF4C4C;
        }
        .en_cours {
            background-color: #F39F4C;
        }
        .trans_done {
            background-color: #00BE5F;
        }
        textarea {
            width: 100%;
            height: 500px;
        }
        .hidden {
            /*display: none;*/
        }
    </style>
    <script type="text/javascript"  src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"  data-key="jquery" ></script>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
</head>
<body>
    <form method="post" action="#">
        <input type="hidden" name="label" value="<?php echo $json_decoded->label; ?>" />
        <?php
            foreach ($json_decoded-> entries as $key => $entry) {
                $trans_done = 'no_trans';
                if (isset($entry->trans_done)) {
                    $trans_done = $entry->trans_done;
                }
        ?>
            <div class="entry_wrapper">
            <fieldset class="<?php echo $trans_done; ?>">
                    <legend><?php echo $entry->name; ?></legend>
                    <input type="hidden" id="entries_<?php echo $key; ?>_id" name="entries[<?php echo $key; ?>][id]" value="<?php echo $entry->id; ?>" />
                    <input type="hidden" id="entries_<?php echo $key; ?>_name" name="entries[<?php echo $key; ?>][name]" value="<?php echo $entry->name; ?>" />
                    <input type="hidden" id="entries_<?php echo $key; ?>_trans_done" name="entries[<?php echo $key; ?>][trans_done]" value="<?php echo $trans_done; ?>" />
                    <textarea id="description_<?php echo $key; ?>"<?php if ($id > -1) { echo ' class="hidden"'; } ?> name="entries[<?php echo $key; ?>][description]"><?php echo $entry->description; ?></textarea>
                    <button id="en_cours_<?php echo $key; ?>" class="btn_edit" value="en_cours">EN COURS</button>
                    <button id="done_<?php echo $key; ?>" class="btn_done" value="trans_done">FIN</button>
                </fieldset>
            </div>
        <?php } ?>
        <input type="submit" value="SAVE" />
    </form>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            jQuery('.btn_edit').on('click', function () {
                var id = jQuery(this).attr('id').replace('en_cours_', '');
                jQuery(this).parent().removeClass();
                jQuery(this).parent().addClass('en_cours');
                jQuery('#entries_' + id + '_trans_done').val('en_cours');
                tinymce.init({
                    selector: '#description_' + id,
                    menu: {
                        source: {title: 'Source', items: 'code'}
                    },
                    plugins: 'code',  // required by the code menu item
                    menubar: 'source'  // adds happy to the menu bar
                });
                return false;
            });

            jQuery('.btn_done').on('click', function () {
                var id = jQuery(this).attr('id').replace('done_', '');
                jQuery(this).parent().removeClass();
                jQuery(this).parent().addClass('trans_done');
                jQuery('#entries_' + id + '_trans_done').val('trans_done');
                return false;
            });
        });
    </script>
</body>
</html>
