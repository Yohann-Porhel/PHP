<script type="text/javascript">
function executer() {
    $.get("<?php echo base_url('rapport/execute') ?>");
    return false;
}
</script>

<a href="#" onclick="executer();">Lancer la génération du rapport</a>