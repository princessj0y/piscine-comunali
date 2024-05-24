<table class="table able-dark table-striped">
    <thead>
        <tr>
            <?php
$cercasupplenze = $_POST['cercasupplenze'];
$iscercasupplenze = $cercasupplenze == 1 || $cercasupplenze == 2 || $cercasupplenze == 3;

if ($iscercasupplenze) {
	echo '<th>Nome</th>';
	echo '<th>Cognome</th>';
}
else {
	echo '<th>Nome</th>';
	echo '<th>Cognome</th>';
	echo '<th>Corso</th>';
	echo '<th>Data</th>';
}
?>
        </tr>
    </thead>
    <tbody>
        <?php
include 'db_conf.php';

if ($cercasupplenze == 1) {
	$query = "SELECT s.istruttoresostituto, 
					p.nome as nomepersona, 
					p.cognome as cognomepersona
			from sostituzione s
				join corso c on s.corso=c.idcorso
				join istruttore i on s.istruttoresostituto=i.idistruttore
				join personale p on i.personaleid=p.idpersona
			WHERE c.edizione = EXTRACT(YEAR FROM NOW())
			group by s.istruttoresostituto, nomepersona, cognomepersona
			having count(*) = 1";
}
else if ($cercasupplenze == 2) {
	$query = "SELECT s.istruttoresostituto, 
					p.nome as nomepersona, 
					p.cognome as cognomepersona
			from sostituzione s
				join corso c on s.corso=c.idcorso
				join istruttore i on s.istruttoresostituto=i.idistruttore
				join personale p on i.personaleid=p.idpersona
			WHERE c.edizione = EXTRACT(YEAR FROM NOW())
			group by s.istruttoresostituto, nomepersona, cognomepersona
			having count(*) <= 2";
}
else if ($cercasupplenze == 3) {
	$query = "SELECT s.istruttoresostituto, 
					p.nome as nomepersona, 
					p.cognome as cognomepersona
			from sostituzione s
				join corso c on s.corso=c.idcorso
				join istruttore i on s.istruttoresostituto=i.idistruttore
				join personale p on i.personaleid=p.idpersona
			WHERE c.edizione = EXTRACT(YEAR FROM NOW())
			group by s.istruttoresostituto, nomepersona, cognomepersona
			having count(*) >= 2";
}
else {
	$query = "SELECT s.istruttoresostituto,
					s.data as datasostituzione,
					p.nome as nomepersona, 
					p.cognome as cognomepersona,
					c.*,
    				v.tipologia as tipovasca,
    				concat(t.nome, ' - ', t.livello) as tipocorso
			from sostituzione s
				join corso c on s.corso=c.idcorso
				join istruttore i on s.istruttoresostituto=i.idistruttore
				join personale p on i.personaleid=p.idpersona
				left join tipologiacorsonuoto t on c.tipocorso=t.tipocorsoid
				join vasca v on v.idvasca=c.vasca
			ORDER BY istruttoresostituto ASC, c.edizione DESC, datasostituzione DESC";
}

$result = pg_query($conn, $query);
if (!$result) {
	echo "Si è verificato un errore .<br/>";
	echo pg_last_error($conn);
	pg_close($conn);
	exit();
}

while ($row = pg_fetch_array($result)) {
	if ($iscercasupplenze) {
		echo '<tr>
<td>' . $row['nomepersona'] . '</td>  
<td>' . $row['cognomepersona'] . '</td></tr>';
	}
	else {
		echo '<tr>
<td>' . $row['nomepersona'] . '</td>
<td>' . $row['cognomepersona'] . '</td>
<td>' . $row['tipocorso'] . ', vasca ' . $row['tipovasca'] . ", corsia " . $row['corsia'] . ", edizione " . $row['edizione'] . '</td>
<td>' . $row['datasostituzione'] . '</td></tr>';
	}
}

// select distinct s.istruttoresostituto from sostituzione s
// join istruttore i on s.istruttoresostituto=i.idistruttore
// join personale p on i.personaleid=p.idpersona
// WHERE c.edizione = EXTRACT(YEAR FROM NOW())
// group by s.istruttoresostituto
// having count(*) >= 2

?>
    </tbody>
</table>