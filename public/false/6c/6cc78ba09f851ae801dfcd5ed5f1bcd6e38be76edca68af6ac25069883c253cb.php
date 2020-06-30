<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* footer.front.twig */
class __TwigTemplate_d4dbc69e91606246317f22bec692fdafb5e726527a95a53a7500d22a04361b87 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<div class=\"container-footer\">

    <div class=\"row no-gutters p-4\">
        <div class=\"item-media-footer p-4 col-md-6 col-sm-12 d-flex justify-content-center align-items-center\">
            <a href=\"\"><i class=\"fab fa-facebook-f\"></i></a>
            <a href=\"\"><i class=\"fab fa-twitter\"></i></a>
            <a href=\"\"><i class=\"fab fa-instagram\"></i></a>
            <a href=\"\"><i class=\"fab fa-google-wallet\"></i></a>
        </div>
        <div class=\"item-link-footer p-4 col-md-6 col-sm-12 d-flex flex-column justify-content-center align-items-center\">
            <a href=\"\">Accueil</a>
            <a href=\"\">A propos</a>
            <a href=\"\">Contact</a>
            <a href=\"\">Mentions Légales</a>
        </div>
    </div>
    <div class=\"copyright p-2 text-center\">Copyright &copy Jean Forteroche 2020</div>

</div>";
    }

    public function getTemplateName()
    {
        return "footer.front.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "footer.front.twig", "/homepages/13/d812002751/htdocs/jean_forteroche/app/View/footer.front.twig");
    }
}
