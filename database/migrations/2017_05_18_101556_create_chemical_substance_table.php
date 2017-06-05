<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChemicalSubstanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // "Элементы"
        // Хим. элементы
        Schema::create('chemical_elements', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });
        // Классы элементов
        Schema::create('chemical_el_classes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });
        // Классы элементов связь
        Schema::create('chemical_el_classes_relation', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('el_id')->unsigned();
            $table->integer('el_class_id')->unsigned();
            $table->foreign('el_id')->references('id')->on('chemical_elements');
            $table->foreign('el_class_id')->references('id')->on('chemical_el_classes');
        });
        // Атомный номер
        Schema::create('atom_number', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('value');
        });
        // Атомный вес
        Schema::create('atom_weight', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('value');
        });
        // Хим. группа
        Schema::create('chemical_el_group', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('value');
        });
        // Хим. период
        Schema::create('chemical_el_period', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('value');
        });
        // Элетроотрицательность
        Schema::create('chemical_el_electronegativity', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('value');
        });
        // Степень окисления
        Schema::create('chemical_el_degree_oxidation', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('value');
        });
        // Валентность
        Schema::create('chemical_el_valience', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('value');
        });
        // Основные свойства элементов
        Schema::create('chemical_el_properties', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('el_id')->unsigned();
            $table->integer('atom_number_id')->unsigned();
            $table->integer('atom_weight_id')->unsigned();
            $table->integer('el_group_id')->unsigned();
            $table->integer('el_period_id')->unsigned();
            $table->integer('el_electronegativity_id')->unsigned();
            $table->integer('el_degree_oxidation_id')->unsigned();
            $table->integer('el_valience_id')->unsigned();
            $table->foreign('el_id')->references('id')->on('chemical_elements');
            $table->foreign('atom_number_id')->references('id')->on('atom_number');
            $table->foreign('atom_weight_id')->references('id')->on('atom_weight');
            $table->foreign('el_group_id')->references('id')->on('chemical_el_group');
            $table->foreign('el_period_id')->references('id')->on('chemical_el_period');
            $table->foreign('el_electronegativity_id')->references('id')->on('chemical_el_electronegativity');
            $table->foreign('el_degree_oxidation_id')->references('id')->on('chemical_el_degree_oxidation');
            $table->foreign('el_valience_id')->references('id')->on('chemical_el_valience');
        });
        // "Вещества"
        // Возможные формулы
        Schema::create('chemical_subs_possible_formules', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });
        // Химические вещества
        Schema::create('chemical_subs_names', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });
        // Фурмулы веществ (связь)
        Schema::create('chemical_subs_name_formula', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('subs_name_id')->unsigned();
            $table->integer('subs_formula_id')->unsigned();
            $table->foreign('subs_name_id')->references('id')->on('chemical_subs_names');
            $table->foreign('subs_formula_id')->references('id')->on('chemical_subs_possible_formules');
        });
        // Кислотный остаток
        Schema::create('chemical_subs_acid_residue', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });
        // Классы веществ
        Schema::create('chemical_subs_classes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });
        // Связь кислоты и кислотного остатка
        Schema::create('chemical_subs_acid_names', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('subs_acid_id')->unsigned();
            $table->integer('subs_class_id')->unsigned();
            $table->foreign('subs_acid_id')->references('id')->on('chemical_subs_acid_residue');
            $table->foreign('subs_class_id')->references('id')->on('chemical_subs_classes');
        });
        // Элементный состав
        // Органические соединения
        Schema::create('chemical_subs_organic', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });
        // Формула органического соединения
        Schema::create('chemical_subs_organic_formula', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });
        // Функциональные группы
        // Список функциональных групп
        Schema::create('chemical_functional_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });
        // Функциональные группы соединения
        Schema::create('chemical_subs_functional_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });
        // Формула функциональной группы
        Schema::create('chemical_func_group_formula', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });
        // Связь функ группы и формулы функ группы
        Schema::create('chemical_func_group_name_formula', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('func_group_id')->unsigned();
            $table->integer('func_group_formula_id')->unsigned();
            $table->foreign('func_group_id')->references('id')->on('chemical_functional_groups');
            $table->foreign('func_group_formula_id')->references('id')->on('chemical_func_group_formula');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::dropIfExists('chemical_elements');
        Schema::dropIfExists('chemical_el_classes');
        Schema::dropIfExists('chemical_el_classes_relation');
        Schema::dropIfExists('atom_number');
        Schema::dropIfExists('atom_weight');
        Schema::dropIfExists('chemical_el_group');
        Schema::dropIfExists('chemical_el_period');
        Schema::dropIfExists('chemical_el_electronegativity');
        Schema::dropIfExists('chemical_el_degree_oxidation');
        Schema::dropIfExists('chemical_el_valience');
        Schema::dropIfExists('chemical_el_properties');
        Schema::dropIfExists('chemical_subs_possible_formules');
        Schema::dropIfExists('chemical_subs_names');
        Schema::dropIfExists('chemical_subs_name_formula');
        Schema::dropIfExists('chemical_subs_acid_residue');
        Schema::dropIfExists('chemical_subs_classes');
        Schema::dropIfExists('chemical_subs_acid_names');
        Schema::dropIfExists('chemical_subs_organic');
        Schema::dropIfExists('chemical_subs_organic_formula');
        Schema::dropIfExists('chemical_functional_groups');
        Schema::dropIfExists('chemical_subs_organic_formula');
        Schema::dropIfExists('chemical_func_group_name_formula');
    }
}
