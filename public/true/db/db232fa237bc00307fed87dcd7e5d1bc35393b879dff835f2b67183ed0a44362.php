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

/* home.front.twig */
class __TwigTemplate_9397dc0292078eb54e090872117d952c14d84c905f65b6d366b9a43878a407d9 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "template.front.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("template.front.twig", "home.front.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "<title>Accueil</title>";
    }

    // line 5
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 6
        echo "
    ";
        // line 7
        if (twig_get_attribute($this->env, $this->source, ($context["session"] ?? null), "flash", [], "any", true, true, false, 7)) {
            // line 8
            echo "    <div id=\"flashMessage\" class=\"bg-";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["session"] ?? null), "color", [], "any", false, false, false, 8), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["session"] ?? null), "flash", [], "any", false, false, false, 8), "html", null, true);
            echo "</div>
    ";
        }
        // line 10
        echo "
    <div class=\"title-bloc-page\">
        <h3><i class=\"fas fa-feather-alt\"></i></h3>
    </div>

    <div class=\"container articles-container\">

    ";
        // line 17
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["articles"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["article"]) {
            // line 18
            echo "
        <div id=\"post\" class=\"bloc-article shadow\">

        <div class=\"picture-container\">
                <img class=\"img-fluid\" src=\"/images/uploads/";
            // line 22
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["article"], "pictureAlt", [], "any", false, false, false, 22), "html", null, true);
            echo "\" alt=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["article"], "title", [], "any", false, false, false, 22), "html", null, true);
            echo "\" class=\"picture-article\"/>
        </div>

        <div class=\"items-article\">
            <h3 class=\"item-title\">";
            // line 26
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["article"], "title", [], "any", false, false, false, 26), "html", null, true);
            echo "</h3>
            <hr/>
            <div class=\"items-bottom\">
                <a class=\"item-btn\" href=\"/article/";
            // line 29
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["article"], "id", [], "any", false, false, false, 29), "html", null, true);
            echo "\">Voir l'article</a>
                <a class=\"item-info\" href=\"#\"><i class=\"fas fa-info-circle\"></i></a>
            </div>
            <div class=\"items-date\">
                <p class=\"item-day\">";
            // line 33
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["article"], "createdAt", [], "any", false, false, false, 33), "d"), "html", null, true);
            echo "</p>
                <p class=\"item-months\">";
            // line 34
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["article"], "createdAt", [], "any", false, false, false, 34), "M"), "html", null, true);
            echo "</p>
            </div>
        </div>

        </div>

    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['article'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 41
        echo "
    </div>

    <nav aria-label=\"...\" class=\"nav-pagination\">
        <ul class=\"home_pagination\">
            ";
        // line 46
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(range(1, ($context["nbPages"] ?? null)));
        foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
            // line 47
            echo "            <li class=\"page-item ";
            if (0 === twig_compare($context["i"], ($context["page"] ?? null))) {
                echo "active";
            }
            echo "\"><a class=\"page-link\" href=\"/home/";
            echo twig_escape_filter($this->env, $context["i"], "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $context["i"], "html", null, true);
            echo "</a></li>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 49
        echo "        </ul>
    </nav>

";
        // line 52
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('flashMessage')->getCallable(), []), "html", null, true);
        echo "

";
    }

    public function getTemplateName()
    {
        return "home.front.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  160 => 52,  155 => 49,  140 => 47,  136 => 46,  129 => 41,  116 => 34,  112 => 33,  105 => 29,  99 => 26,  90 => 22,  84 => 18,  80 => 17,  71 => 10,  63 => 8,  61 => 7,  58 => 6,  54 => 5,  47 => 3,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "home.front.twig", "/homepages/13/d812002751/htdocs/jean_forteroche/app/View/home.front.twig");
    }
}
