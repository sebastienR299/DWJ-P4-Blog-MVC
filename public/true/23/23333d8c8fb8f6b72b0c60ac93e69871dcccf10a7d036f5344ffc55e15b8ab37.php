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

/* sidebar.twig */
class __TwigTemplate_2a968da9730144b91ee754e782d8289ac192b421c7e89bceb9ca3fb3d2b67002 extends Template
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
        echo "    <button id=\"hamburger\" class=\"hamburger hamburger--elastic\" type=\"button\">
            <span class=\"hamburger-box\">
            <span class=\"hamburger-inner\"></span>
            </span>
    </button>

    <h4 class=\"logo-header\">Jean Forteroche <i class=\"fas fa-feather-alt\"></i></h4>

    <div class=\"nav-menu\" id=\"menu-sidebar\">

        <div class=\"menu-title\">

        ";
        // line 13
        if (0 === twig_compare(twig_get_attribute($this->env, $this->source, ($context["session"] ?? null), "logged", [], "any", false, false, false, 13), true)) {
            // line 14
            echo "        <div class=\"user-text-container\">
            <span><i class=\"fas fa-user\"></i></span>
            <h4 class=\"user-sidebar\">";
            // line 16
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["session"] ?? null), "firstName", [], "any", false, false, false, 16), "html", null, true);
            echo " ";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["session"] ?? null), "lastName", [], "any", false, false, false, 16), "html", null, true);
            echo "</h4>
        </div>
        ";
        }
        // line 19
        echo "
            <a id=\"link\" class=\"link-mobile\" href=\"/home/1\"><i class=\"fas fa-home\"></i> Home</a>
            <a id=\"link\" class=\"link-mobile\" href=\"#\"><i class=\"fas fa-info-circle\"></i> A propos</a>
            ";
        // line 22
        if (0 === twig_compare(twig_get_attribute($this->env, $this->source, ($context["session"] ?? null), "logged", [], "any", false, false, false, 22), false)) {
            // line 23
            echo "            <a id=\"link\" class=\"link-mobile\" href=\"/connexion\"><i class=\"fas fa-sign-in-alt\"></i> Connexion</a>
            <a id=\"link\" class=\"link-mobile\" href=\"/inscription\"><i class=\"fas fa-user-plus\"></i> Inscription</a>
            ";
        }
        // line 26
        echo "            ";
        if (0 === twig_compare(twig_get_attribute($this->env, $this->source, ($context["session"] ?? null), "logged", [], "any", false, false, false, 26), true)) {
            // line 27
            echo "            <a id=\"link\" class=\"link-mobile\" href=\"/logout\"><i class=\"fas fa-sign-out-alt\"></i> Déconnexion</a>
            ";
        }
        // line 29
        echo "            ";
        if (0 === twig_compare(twig_get_attribute($this->env, $this->source, ($context["session"] ?? null), "admin", [], "any", false, false, false, 29), 1)) {
            // line 30
            echo "            <a id=\"e6\" class=\"link-mobile\" href=\"/homeBack/1\"><i class=\"fas fa-tachometer-alt\"></i> Dashboard</a>
            ";
        }
        // line 32
        echo "        </div>
    </div>";
    }

    public function getTemplateName()
    {
        return "sidebar.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  91 => 32,  87 => 30,  84 => 29,  80 => 27,  77 => 26,  72 => 23,  70 => 22,  65 => 19,  57 => 16,  53 => 14,  51 => 13,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "sidebar.twig", "/homepages/13/d812002751/htdocs/jean_forteroche/app/View/sidebar.twig");
    }
}
