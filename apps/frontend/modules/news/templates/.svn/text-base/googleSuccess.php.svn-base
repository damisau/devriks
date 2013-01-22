<div class="breadcrumb_pink"><?php echo $breadcrumb; ?></div>
<h1>News on regional integration powered by &nbsp;

    <a href="http://news.google.com" target="_blank"  title="Google news">
        <img src="/riks/web/images/news.gif" width="100" border="0">
    </a>
</h1>
<p class="bodytext">The following is a sample of the latest Google news items on
    regional integration. Clicking on the links will redirect you to the original publisher
    of the news. The presented items are selected by relevance criteria applied by the Google
    news system.

    <form action="<?php echo url_for('news/google'); ?>" method="POST" onChange="submit()">
        <table>
            <tr>
                <td class="bodytext">You can choose different languages: &nbsp; &nbsp;</td>
                <td align="right" valign="top">
                    <SELECT NAME="newsLanguages" SIZE="1" onChange="this.form.submit();">
                        <option>Select your language</option>
                        <option value="en">English: regional integration</option>
                        <option value="fr">French: int&eacute;gration r&eacute;gionale</option>
                        <option value="es">Spanish: integraci&oacute;n regional</option>
                    </select>
                </td>
            </tr>
        </table>
    </form>

</p>
<?php
for($i=0; $i<$postCount; $i++){            
    echo $sf_data->getRaw('post'.$i)->getDescription();
}
?>    
</p>
