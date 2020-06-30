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

/* article.back.twig */
class __TwigTemplate_7f4cfd7c86515f1fc0df0f872d290305512ba19cb22fa86c9a306e2952b8bb98 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'content' => [$this, 'block_content'],
            'title' => [$this, 'block_title'],
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
        $this->parent = $this->loadTemplate("template.back.twig", "article.back.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 4
        echo "
    ";
        // line 5
        if (twig_get_attribute($this->env, $this->source, ($context["session"] ?? null), "flash", [], "any", true, true, false, 5)) {
            // line 6
            echo "        <div id=\"flashMessage\" class=\"bg-";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["session"] ?? null), "color", [], "any", false, false, false, 6), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["session"] ?? null), "flash", [], "any", false, false, false, 6), "html", null, true);
            echo "</div>
    ";
        }
        // line 8
        echo "
    <div class=\"container article-view-back\">

    ";
        // line 11
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["article"] ?? null));
        $context['loop'] = [
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        ];
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["row"]) {
            // line 12
            echo "
    ";
            // line 13
            $this->displayBlock('title', $context, $blocks);
            // line 14
            echo "
        <div class=\"bloc_article_single shadow\">
        <img src=\"/images/uploads/";
            // line 16
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["row"], "pictureAlt", [], "any", false, false, false, 16), "html", null, true);
            echo "\" alt=\"\" class=\"img-profil\"/>
            <div class=\"items_article\">
                <h4 class=\"title_article_single\">";
            // line 18
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["row"], "title", [], "any", false, false, false, 18), "html", null, true);
            echo "</h4>
                <p class=\"p_article_single\">";
            // line 19
            echo twig_get_attribute($this->env, $this->source, $context["row"], "content", [], "any", false, false, false, 19);
            echo "</p>
            </div>
            <div class=\"btn_article\">
                <a class=\"btn_single\" href=\"?p=homeBack&page=1\">Retour aux articles</a>
                <a class=\"btn_single\" href=\"?p=articleBackUpdate&id=";
            // line 23
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["row"], "id", [], "any", false, false, false, 23), "html", null, true);
            echo "\">Modifier</a>
                <p class=\"date_single\">";
            // line 24
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["article"] ?? null), "createdAt", [], "any", false, false, false, 24), "d-m-Y"), "html", null, true);
            echo "</p>
            </div>
        </div>


    ";
            // line 29
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["comments"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["comment"]) {
                // line 30
                echo "
    <div class=\"bloc_comment shadow-sm\">
        <h5 class=\"title_comment\">";
                // line 32
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["comment"], "firstName", [], "any", false, false, false, 32), "html", null, true);
                echo " ";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["comment"], "lastName", [], "any", false, false, false, 32), "html", null, true);
                echo "</h5>
            <p class=\"p_comment\">";
                // line 33
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["comment"], "content", [], "any", false, false, false, 33), "html", null, true);
                echo "<p>
        <div class=\"bloc_bottom_comment\">
            <p class=\"date_comment\">";
                // line 35
                echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["comment"], "createdAt", [], "any", false, false, false, 35), "d-m-Y"), "html", null, true);
                echo "</p>
            ";
                // line 36
                if (0 === twig_compare(twig_get_attribute($this->env, $this->source, ($context["session"] ?? null), "logged", [], "any", false, false, false, 36), true)) {
                    // line 37
                    echo "            <a href=\"?p=reportComment&id=";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["row"], "id", [], "any", false, false, false, 37), "html", null, true);
                    echo "&idComment=";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["comment"], "id", [], "any", false, false, false, 37), "html", null, true);
                    echo "#post\">
            ";
                    // line 38
                    if (0 === twig_compare(twig_get_attribute($this->env, $this->source, $context["comment"], "report", [], "any", false, false, false, 38), 0)) {
                        // line 39
                        echo "            <span class=\"icon_comment\" style=\"color:#333333\"><i class=\"fas fa-exclamation-triangle\"></i></span>
            ";
                    } else {
                        // line 41
                        echo "            <span class=\"icon_comment\" style=\"color:#dc3545\"><i class=\"fas fa-exclamation-triangle\"></i></span>
            ";
                    }
                    // line 43
                    echo "            </a>
            ";
                }
                // line 45
                echo "        </div>
    </div>

    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['comment'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 49
            echo "
    </div>

    ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['row'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 53
        echo "
";
        // line 54
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('flashMessage')->getCallable(), []), "html", null, true);
        echo "

";
    }

    // line 13
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "<title>";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["row"] ?? null), "title", [], "any", false, false, false, 13), "html", null, true);
        echo "</title>";
    }

    public function getTemplateName()
    {
        return "article.back.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  205 => 13,  198 => 54,  195 => 53,  178 => 49,  169 => 45,  165 => 43,  161 => 41,  157 => 39,  155 => 38,  148 => 37,  146 => 36,  142 => 35,  137 => 33,  131 => 32,  127 => 30,  123 => 29,  115 => 24,  111 => 23,  104 => 19,  100 => 18,  95 => 16,  91 => 14,  89 => 13,  86 => 12,  69 => 11,  64 => 8,  56 => 6,  54 => 5,  51 => 4,  47 => 3,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "article.back.twig", "/homepages/13/d812002751/htdocs/jean_forteroche/app/View/article.back.twig");
    }
}
