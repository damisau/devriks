<div class="breadcrumb_green"><?php echo $breadcrumb ?></div>
<h1>Regional Arrangements</h1>
<p>In this section you can explore regional arrangements and single countries.<br>
    Selecting an arrangement will show a map of the selected arrangement together
    with a basic description and the member countries.
</p>
<p>
    Selecting a country provides an overview of the regional arrangements the
    selected country is involved in, together with related legal texts and
    information from other quantitative and qualitative data sources.
</p>
<table>
    <tbody>
        <p>
            <form action="<?php echo url_for('arrangement/show')?>" method="GET" name="selectArrangement">
                <select name="id">
                    <option value="Select an arrangement">--- Select an arrangement ---</option>
                    <?php foreach($rikssym_arrangement_list as $rikssym_arrangement): ?>
                    <option value="<?php  echo $rikssym_arrangement->getId() ?>">
                        <?php echo $rikssym_arrangement->getName() ?>
                    </option>
                    <?php endforeach; ?>
                </select>
                <input type="submit" value="View Arrangement">
            </form>
        </p>
        <p>
            <form action="<?php echo url_for('country/show')?>" method="GET" name="selectCountry">
                <select name="id">
                    <option value="Select a country">--- Select a country ---</option>
                    <?php foreach($rikssym_country_list as $rikssym_country): ?>
                    <option value="<?php  echo $rikssym_country->getName() ?>">
                        <?php echo $rikssym_country->getName() ?>
                    </option>
                    <?php endforeach; ?>
                </select>
                <input type="submit" value="View Country">
            </form>
        </p>
    </tbody>
</table>