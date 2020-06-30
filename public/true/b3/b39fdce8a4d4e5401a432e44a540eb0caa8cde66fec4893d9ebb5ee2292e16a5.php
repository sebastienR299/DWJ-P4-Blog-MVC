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

/* header.back.twig */
class __TwigTemplate_3e890a7c3d76059e1494cae8ea3f845352d24f94257cb1d5cfe64239fba8a151 extends Template
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
        echo "<button id=\"hamburger-back\" class=\"hamburger hamburger--elastic\" type=\"button\">
            <span class=\"hamburger-box\">
            <span class=\"hamburger-inner\"></span>
            </span>
</button>

<nav id=\"navbar-back\">
    <div class=\"navbar-back-container\">
        <div class=\"items-nav-back\">
            <a class=\"nav-back-link\" href=\"/home/1\"><i class=\"fas fa-home\"></i> Accueil</a>
            <a class=\"nav-back-link\" href=\"/homeBack/1\"><i class=\"fas fa-tachometer-alt\"></i> Dashboard</a>
            <a class=\"nav-back-link\" href=\"/viewAddArticle\"><i class=\"fas fa-pencil-alt\"></i> Créer un article</a>
            <a class=\"nav-back-link\" href=\"/viewReportComment\"><i class=\"far fa-bell\"></i> Modérations <span>";
        // line 13
        echo twig_escape_filter($this->env, twig_length_filter($this->env, ($context["reportComment"] ?? null)), "html", null, true);
        echo "</span></a>
        </div>
        <div class=\"items-infos-navbar\">
            <div class=\"infos-back-publications\">
                <p><span>";
        // line 17
        echo twig_escape_filter($this->env, twig_length_filter($this->env, ($context["articles"] ?? null)), "html", null, true);
        echo "</span> Publications</p>
                <p><span>";
        // line 18
        echo twig_escape_filter($this->env, twig_length_filter($this->env, ($context["comments"] ?? null)), "html", null, true);
        echo "</span> Commentaires</p>
                <p><span>";
        // line 19
        echo twig_escape_filter($this->env, twig_length_filter($this->env, ($context["users"] ?? null)), "html", null, true);
        echo "</span> Utilisateurs</p>
            </div>
        </div>
    </div>
</nav>";
    }

    public function getTemplateName()
    {
        return "header.back.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  66 => 19,  62 => 18,  58 => 17,  51 => 13,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "header.back.twig", "/homepages/13/d812002751/htdocs/jean_forteroche/app/View/header.back.twig");
    }
}
