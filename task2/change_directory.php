<?php
include "PathUtils.php";
include "Path.php";

$path = new Path( '/a/b/c/d' );
echo $path->getCurrentPath()."\n";

$path->cd("e/f/..")
->cd("my_dir/is_beautiful");

echo $path->getCurrentPath()."\n";

$path->cd("../../../../../../../../../../../../../../../../../../../hello");
echo $path->getCurrentPath()."\n";