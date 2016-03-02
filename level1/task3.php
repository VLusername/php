<?php
include "../header.php";
include "../connect.php";

echo("<div id='content'>
<div>
    Задача 3. Нужно считать данные из базы данных в массив и вывести их (из массива) на экран в формате<br><br>");
/*
DELIMITER //
CREATE PROCEDURE GetValues()
BEGIN
SET @SQL = NULL;
SELECT
  GROUP_CONCAT(DISTINCT
    CONCAT('sum(case when Date_format(Date, ''%m.%Y'') = ''',myDate,''' then Value else 0 end) AS ''',myDate, '''')
  ) INTO @SQL
FROM
(
  SELECT Date_format(Date, '%m.%Y') AS myDate FROM tb_results
) d;
SET @SQL
  = CONCAT('SELECT tb_accounts.AcountName, ', @SQL, '
  from tb_results
  inner join tb_accounts on tb_results.AccountID = tb_accounts.AccountID
  group by AcountName desc;');

PREPARE stmt FROM @SQL;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
END//
DELIMITER ;
 */
    $dataQuery = $mysqli->query("CALL GetValues()");
    $count = $mysqli->field_count;

    echo ("<table><tr><td></td>");
    for($i = 1; $i < $count; $i++){
        echo("<td>" . mysqli_fetch_field_direct($dataQuery, $i)->name . "</td>");}
    echo ("</tr>");

    while($row = $dataQuery->fetch_array()) {
        echo ("<tr>");
        for ($i = 0; $i < $count; $i++) {
            echo("<td>" . $row[$i] . "</td>");
        }
        echo ("</tr>");
    }
    include "../connect.php";
    $summaQuery = $mysqli->query("select `Date`, SUM(Value) as `summa`
                                  from `tb_results`, `tb_accounts`
                                  where tb_results.AccountID = tb_accounts.AccountID
                                  group by `Date`
                                  order by AcountName desc");
    echo ("</tr><tr><td>Summa</td>");
    while($rowSumma = $summaQuery->fetch_assoc())
    {
        echo ("<td>".$rowSumma['summa']."</td>");
    }
    echo ("</tr></table>
</div>
</div>
</body>
</html>");