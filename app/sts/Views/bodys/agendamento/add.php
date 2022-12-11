
<?php $date = new \DateTime($_GET['date'], new \DateTimeZone('America/Sao_Paulo')); ?>

<form name="formAdd" id="formAdd" method="POST" action="<?php echo DIRPAGE.'controller/ControllerAdd.php';?>">

    Data: <input type="date" name="date" id="date" value="<?php echo $date->format("Y-m-d"); ?>"> <br>

    Hora: <input type="time" name="time" id="time" value="<?php echo $date->format("H:i"); ?>"> <br>

    Cliente: <input type="text" name="title" id="title"> <br>

    Descrição: <input type="text" name="description" id="description"> <br>

    Tempo de Atendimento:
    <select name="horasAtendimento" id="horasAtendimento">
        <option value="">Selecione</option>
        <option value="1">1h</option>
        <option value="2">2h</option>
        <option value="3">3h</option>
    </select> <br>
    
    <input type="submit" value="Marcar Consulta">
</form>

