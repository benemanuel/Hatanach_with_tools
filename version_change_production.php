<?PHP
$update_str = strtotime("2023-05-05 00:00:00");
$diff = floor((time() - $update_str) / (60 * 60 * 24));
if ($diff < 3) {
echo "<h3> גירסה חדשה. גירסה הקודם אפשר למצע ב
New version. old version can be found at
<a target = '_blank' href='https://hatanach.geulah.org.il/verse/previous/'>Previous version </a>
</h3>";
}
echo '<div class="hidden" style="display: none;"> update was '. $diff. ' days ago  </div>';
