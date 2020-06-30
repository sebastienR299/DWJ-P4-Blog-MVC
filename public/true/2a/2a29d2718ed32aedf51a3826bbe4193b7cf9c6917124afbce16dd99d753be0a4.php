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

/* home.back.twig */
class __TwigTemplate_c017254e11b10fb3cd0867811c82d50bc17132024f04e6341c2a5885cd8676b6 extends Template
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
        return "template.back.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("template.back.twig", "home.back.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "<title>Tabeau de bord</title>";
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
    ";
        // line 12
        echo "    <div class=\"container-fluid articles-back-container-fluid\">

    ";
        // line 15
        echo "    ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["articles"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["article"]) {
            // line 16
            echo "        <div class=\"container articles-back-container\">
            <div class=\"bloc_article_back shadow\">
            <div class=\"title-back-container\">
                <h4 class=\"title_back\">";
            // line 19
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["article"], "title", [], "any", false, false, false, 19), "html", null, true);
            echo "</h4>
            </div>
            <div class=\"link-back\">
                <a class=\"btn-view\" href=\"/articleBack/";
            // line 22
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["article"], "id", [], "any", false, false, false, 22), "html", null, true);
            echo "\"><i class=\"fas fa-eye\"></i> Lire</a>
                <a class=\"btn-write\" href=\"#\"><i class=\"fas fa-pen\"></i> Modifier</a>
                <a class=\"btn-delete\" href=\"/deleteArticle/";
            // line 24
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["article"], "id", [], "any", false, false, false, 24), "html", null, true);
            echo "\" onclick=\"return confirm('Voulez-vous vraiment supprimer l'article ";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["article"], "title", [], "any", false, false, false, 24), "html", null, true);
            echo " ?');\"><i class=\"fas fa-trash-alt\"></i> Supprimer</a>
            </div>
            </div>
        </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['article'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 29
        echo "
    </div>

    <nav aria-label=\"...\" class=\"nav-pagination\">
        <ul class=\"home_pagination\">
            ";
        // line 34
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(range(1, ($context["nbPages"] ?? null)));
        foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
            // line 35
            echo "            <li class=\"page-item ";
            if (0 === twig_compare($context["i"], ($context["page"] ?? null))) {
                echo "active";
            }
            echo "\"><a class=\"page-link\" href=\"/homeBack/";
            echo twig_escape_filter($this->env, $context["i"], "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $context["i"], "html", null, true);
            echo "</a></li>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 37
        echo "        </ul>
    </nav>

    ";
        // line 40
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('flashMessage')->getCallable(), []), "html", null, true);
        echo "

";
    }

    public function getTemplateName()
    {
        return "home.back.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  143 => 40,  138 => 37,  123 => 35,  119 => 34,  112 => 29,  99 => 24,  94 => 22,  88 => 19,  83 => 16,  78 => 15,  74 => 12,  71 => 10,  63 => 8,  61 => 7,  58 => 6,  54 => 5,  47 => 3,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "home.back.twig", "/homepages/13/d812002751/htdocs/jean_forteroche/app/View/home.back.twig");
    }
}
