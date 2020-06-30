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

/* article.front.twig */
class __TwigTemplate_8007b1d30780315bd609e9aa34fe3f96d2e1927b55b0b824f989348e6abb1a58 extends Template
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
        $this->parent = $this->loadTemplate("template.front.twig", "article.front.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "<title>article n°";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["row"] ?? null), "id", [], "any", false, false, false, 3), "html", null, true);
        echo "</title>";
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
            echo "        <div id=\"flashMessage\" class=\"bg-";
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

    <div class=\"container\">

    ";
        // line 17
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["article"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["row"]) {
            // line 18
            echo "
        <div class=\"bloc_article_single shadow\">
        <img src=\"/images/uploads/";
            // line 20
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["row"], "pictureAlt", [], "any", false, false, false, 20), "html", null, true);
            echo "\" alt=\"\" class=\"img-profil\"/>
            <div class=\"items_article\">
                <h4 class=\"title_article_single\">";
            // line 22
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["row"], "title", [], "any", false, false, false, 22), "html", null, true);
            echo "</h4>
                <p class=\"p_article_single\">";
            // line 23
            echo twig_get_attribute($this->env, $this->source, $context["row"], "content", [], "any", false, false, false, 23);
            echo "</p>
            </div>
            <div class=\"btn_article\">";
            // line 27
            echo "<a id=\"returnPageHome\" class=\"btn_single\" href=\"#\">Retour aux articles</a>
                <p class=\"date_single\">";
            // line 28
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["article"] ?? null), "createdAt", [], "any", false, false, false, 28), "d-m-Y"), "html", null, true);
            echo "</p>
            </div>
        </div>

    </div>

    <div class=\"container\">

    ";
            // line 36
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["comments"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["comment"]) {
                // line 37
                echo "
    <div id=\"report_comments\" class=\"bloc_comment shadow-sm\">
        <h5 class=\"title_comment\">";
                // line 39
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["comment"], "firstName", [], "any", false, false, false, 39), "html", null, true);
                echo " ";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["comment"], "lastName", [], "any", false, false, false, 39), "html", null, true);
                echo "</h5>
            <p class=\"p_comment\">";
                // line 40
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["comment"], "content", [], "any", false, false, false, 40), "html", null, true);
                echo "<p>
        <div class=\"bloc_bottom_comment\">
            <p class=\"date_comment\">";
                // line 42
                echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["comment"], "createdAt", [], "any", false, false, false, 42), "d-m-Y"), "html", null, true);
                echo "</p>
            ";
                // line 43
                if (0 === twig_compare(twig_get_attribute($this->env, $this->source, ($context["session"] ?? null), "logged", [], "any", false, false, false, 43), true)) {
                    // line 44
                    echo "            <a href=\"/reportComment/";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["row"], "id", [], "any", false, false, false, 44), "html", null, true);
                    echo "/";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["comment"], "id", [], "any", false, false, false, 44), "html", null, true);
                    echo "/#report_comments\">
            ";
                    // line 45
                    if (0 === twig_compare(twig_get_attribute($this->env, $this->source, $context["comment"], "report", [], "any", false, false, false, 45), 0)) {
                        // line 46
                        echo "            <span class=\"icon_comment\" style=\"color:#333333\"><i class=\"fas fa-exclamation-triangle\"></i></span>
            ";
                    } else {
                        // line 48
                        echo "            <span class=\"icon_comment\" style=\"color:#dc3545\"><i class=\"fas fa-exclamation-triangle\"></i></span>
            ";
                    }
                    // line 50
                    echo "            </a>
            ";
                }
                // line 52
                echo "        </div>
    </div>

    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['comment'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 56
            echo "
    ";
            // line 57
            if (0 === twig_compare(twig_get_attribute($this->env, $this->source, ($context["session"] ?? null), "logged", [], "any", false, false, false, 57), true)) {
                // line 58
                echo "    <form method=\"POST\" action=\"/addComment/";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["row"], "id", [], "any", false, false, false, 58), "html", null, true);
                echo "/#anchor_comments\" class=\"bloc_add_comment shadow-sm\" id=\"write-comment\">
        <div class=\"form-group\">
            <label for=\"content\">Message</label>
            <textarea class=\"form-control form-control-lg\" id=\"_content-comment\" name=\"content\" rows=\"5\"></textarea>
        </div>
        <button type=\"submit\" class=\"btn_add_comment\">Ajouter</button>
    </form>
    ";
            }
            // line 66
            echo "
    </div>

    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['row'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 70
        echo "
";
        // line 71
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('flashMessage')->getCallable(), []), "html", null, true);
        echo "

";
    }

    public function getTemplateName()
    {
        return "article.front.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  202 => 71,  199 => 70,  190 => 66,  178 => 58,  176 => 57,  173 => 56,  164 => 52,  160 => 50,  156 => 48,  152 => 46,  150 => 45,  143 => 44,  141 => 43,  137 => 42,  132 => 40,  126 => 39,  122 => 37,  118 => 36,  107 => 28,  104 => 27,  99 => 23,  95 => 22,  90 => 20,  86 => 18,  82 => 17,  73 => 10,  65 => 8,  63 => 7,  60 => 6,  56 => 5,  47 => 3,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "article.front.twig", "/homepages/13/d812002751/htdocs/jean_forteroche/app/View/article.front.twig");
    }
}
