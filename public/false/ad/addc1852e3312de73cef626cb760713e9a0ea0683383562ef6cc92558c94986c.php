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

/* connexion.front.twig */
class __TwigTemplate_6eb157334428b24ef7cf497a76a04ddbe3654e4c682ece1e1867a257e6a32e7a extends Template
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
        $this->parent = $this->loadTemplate("template.front.twig", "connexion.front.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "<title>Connexion</title>";
    }

    // line 5
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 6
        echo "
    <div class=\"title-bloc-page\">
        <h3><i class=\"fas fa-sign-in-alt\"></i></h3>
    </div>

<div class=\"container container_connexion\">

<form method=\"post\" action=\"/signIn\" id=\"bloc_connexion\" class=\"mx-auto col-lg-4 col-sm-8 mt-5\" autocomplete=\"off\">
    <div class=\"form-group item\">
        <input type=\"email\" class=\"form-control form-control-lg\" name=\"email\" id=\"email\" aria-describedby=\"emailHelp\">
        <label for=\"email\" class=\"ml-4 label_connexion\">Email <span>*</span></label>
    </div>
    <div class=\"form-group item\">
        <input type=\"password\" class=\"form-control form-control-lg\" name=\"password\" id=\"password\">
        <label for=\"password\" class=\"ml-4\">Password <span>*</span></label>
    </div>
    <button type=\"submit\" class=\"btn btn-primary btn-lg d-block mx-auto\">Connexion</button>
</form>

";
        // line 25
        if (twig_get_attribute($this->env, $this->source, ($context["session"] ?? null), "flash", [], "any", true, true, false, 25)) {
            // line 26
            echo "    <div id=\"flashMessage\" class=\"bg-";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["session"] ?? null), "color", [], "any", false, false, false, 26), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["session"] ?? null), "flash", [], "any", false, false, false, 26), "html", null, true);
            echo "</div>
";
        }
        // line 28
        echo "
</div>

";
        // line 31
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('flashMessage')->getCallable(), []), "html", null, true);
        echo "

";
    }

    public function getTemplateName()
    {
        return "connexion.front.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  94 => 31,  89 => 28,  81 => 26,  79 => 25,  58 => 6,  54 => 5,  47 => 3,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "connexion.front.twig", "/homepages/13/d812002751/htdocs/jean_forteroche/app/View/connexion.front.twig");
    }
}
