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

/* inscription.front.twig */
class __TwigTemplate_d160eb9f82bf273eaeb05c9a3aa87e71f0364e688266356af57276ddca256e80 extends Template
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
        $this->parent = $this->loadTemplate("template.front.twig", "inscription.front.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "<title>Inscription</title>";
    }

    // line 5
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 6
        echo "
<div class=\"title-bloc-page\">
    <h3><i class=\"fas fa-user-plus\"></i></h3>
</div>

<div class=\"container container_inscription\">

<form  class=\"bloc_inscription\" method=\"post\" action=\"?p=register\" class=\"mx-auto col-lg-4 col-sm-8 mt-5\" autocomplete=\"off\">
    <div class=\"form-group item\">
        <input required type=\"text\" class=\"form-control form-control-lg\" name=\"firstName\" id=\"firstName\" aria-describedby=\"firstNameHelp\">
        <label for=\"firstName\" class=\"ml-4\">Prénom <span>*</span></label>
    </div>
    <div class=\"form-group item\">
        <input required  type=\"text\" class=\"form-control form-control-lg\" name=\"lastName\" id=\"lastName\" aria-describedby=\"LastNameHelp\">
        <label for=\"lastName\" class=\"ml-4\">Nom <span>*</span></label>
    </div>
    <div class=\"form-group item\">
        <input required  type=\"email\" class=\"form-control form-control-lg\" name=\"email\" id=\"email\" aria-describedby=\"emailHelp\">
        <label for=\"email\" class=\"ml-4\">Email <span>*</span></label>
    </div>
    <div class=\"form-group item\">
        <input required  type=\"password\" class=\"form-control form-control-lg\" name=\"password\" id=\"password\">
        <label for=\"password\" class=\"ml-4\">Mot de passe <span>*</span></label>
    </div>
    <div class=\"form-group item\">
        <input required  type=\"password\" class=\"form-control form-control-lg\" name=\"passwordRepeat\" id=\"passwordRepeat\">
        <label for=\"passwordRepeat\" class=\"ml-4\">Mot de passe <span>*</span></label>
    </div>
    <button type=\"submit\" class=\"btn btn-primary btn-lg d-block mx-auto\">Inscription</button>
</form>

";
        // line 37
        if (twig_get_attribute($this->env, $this->source, ($context["session"] ?? null), "flash", [], "any", true, true, false, 37)) {
            // line 38
            echo "    <div id=\"flashMessage\" class=\"bg-";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["session"] ?? null), "color", [], "any", false, false, false, 38), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["session"] ?? null), "flash", [], "any", false, false, false, 38), "html", null, true);
            echo "</div>
";
        }
        // line 40
        echo "
</div>

";
        // line 43
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('flashMessage')->getCallable(), []), "html", null, true);
        echo "

";
    }

    public function getTemplateName()
    {
        return "inscription.front.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  106 => 43,  101 => 40,  93 => 38,  91 => 37,  58 => 6,  54 => 5,  47 => 3,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "inscription.front.twig", "/homepages/13/d812002751/htdocs/jean_forteroche/app/View/inscription.front.twig");
    }
}
