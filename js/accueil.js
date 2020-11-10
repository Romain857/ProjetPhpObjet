$(document).ready(function() {
    $(".more").on("click", function() {
        $b=$(this);
        $t=$b.text();
        if($t==="+") {
            $t="-";
            $b.parent("article").children(".contenu").addClass("contenu_normal");
            $b.parent("article").children(".contenu").removeClass("contenu_hide");
        }
        else {
            $t="+";
            $b.parent("article").children(".contenu").removeClass("contenu_normal");
            $b.parent("article").children(".contenu").addClass("contenu_hide");
        }
        $b.text($t);
    });
} );