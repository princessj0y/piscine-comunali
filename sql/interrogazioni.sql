-- a. Determinare gli istruttori supplenti che 
--    hanno esattamente una supplenza nella stagione corrente 
SELECT s.istruttoresostituto,
    p.nome as nomepersona,
    p.cognome as cognomepersona
from sostituzione s
    join corso c on s.corso = c.idcorso
    join istruttore i on s.istruttoresostituto = i.idistruttore
    join personale p on i.personaleid = p.idpersona
group by s.istruttoresostituto,
    nomepersona,
    cognomepersona
having count(*) = 1;
-- b. Determinare gli istruttori supplenti che 
--    hanno almeno due supplenze nella stagione corrente 
SELECT s.istruttoresostituto,
    p.nome as nomepersona,
    p.cognome as cognomepersona
from sostituzione s
    join corso c on s.corso = c.idcorso
    join istruttore i on s.istruttoresostituto = i.idistruttore
    join personale p on i.personaleid = p.idpersona
group by s.istruttoresostituto,
    nomepersona,
    cognomepersona
having count(*) >= 2;
-- c. Determinare gli istruttori supplenti che 
--    hanno non più di due supplenze nella stagione corrente
SELECT s.istruttoresostituto,
    p.nome as nomepersona,
    p.cognome as cognomepersona
from sostituzione s
    join corso c on s.corso = c.idcorso
    join istruttore i on s.istruttoresostituto = i.idistruttore
    join personale p on i.personaleid = p.idpersona
group by s.istruttoresostituto,
    nomepersona,
    cognomepersona
having count(*) <= 2;