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

/* header.front.twig */
class __TwigTemplate_715690ec2e15c7edab3c9412ce08075fb912ad4180d89f91487976794ca032c0 extends Template
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
        echo "<header id=\"home\" class=\"parallax\">

    <div class=\"header-text\">
        <h1 id=\"title_1\">Billet simple pour l'Alaska</h1>
    </div>

</header>";
    }

    public function getTemplateName()
    {
        return "header.front.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "header.front.twig", "/homepages/13/d812002751/htdocs/jean_forteroche/app/View/header.front.twig");
    }
}
