<?php

declare(strict_types=1);

namespace Modules\Predict\Models;

use Modules\Blog\Models\Category as BaseCategory;

/**
 * @property string                                                                                                     $id
 * @property array                                                                                                      $title
 * @property string                                                                                                     $slug
 * @property string|null                                                                                                $parent_id
 * @property \Illuminate\Support\Carbon|null                                                                            $created_at
 * @property \Illuminate\Support\Carbon|null                                                                            $updated_at
 * @property array|null                                                                                                 $description
 * @property string|null                                                                                                $icon
 * @property string|null                                                                                                $updated_by
 * @property string|null                                                                                                $created_by
 * @property \Illuminate\Support\Carbon|null                                                                            $deleted_at
 * @property string|null                                                                                                $deleted_by
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\Blog\Models\Article>                                $articles
 * @property int|null                                                                                                   $articles_count
 * @property \Modules\Blog\Models\Banner|null                                                                           $banner
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\Blog\Models\Article>                                $categoryArticles
 * @property int|null                                                                                                   $category_articles_count
 * @property \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection|Category[]                                           $children
 * @property int|null                                                                                                   $children_count
 * @property \Modules\Blog\Models\Profile|null                                                                          $creator
 * @property \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Modules\Media\Models\Media> $media
 * @property int|null                                                                                                   $media_count
 * @property Category|null                                                                                              $parent
 * @property mixed                                                                                                      $translations
 * @property \Modules\Blog\Models\Profile|null                                                                          $updater
 * @property \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection|Category[]                                           $ancestors                  The model's recursive parents.
 * @property int|null                                                                                                   $ancestors_count
 * @property \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection|Category[]                                           $ancestorsAndSelf           The model's recursive parents and itself.
 * @property int|null                                                                                                   $ancestors_and_self_count
 * @property \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection|Category[]                                           $bloodline                  The model's ancestors, descendants and itself.
 * @property int|null                                                                                                   $bloodline_count
 * @property \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection|Category[]                                           $childrenAndSelf            The model's direct children and itself.
 * @property int|null                                                                                                   $children_and_self_count
 * @property \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection|Category[]                                           $descendants                The model's recursive children.
 * @property int|null                                                                                                   $descendants_count
 * @property \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection|Category[]                                           $descendantsAndSelf         The model's recursive children and itself.
 * @property int|null                                                                                                   $descendants_and_self_count
 * @property \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection|Category[]                                           $parentAndSelf              The model's direct parent and itself.
 * @property int|null                                                                                                   $parent_and_self_count
 * @property Category|null                                                                                              $rootAncestor               The model's topmost parent.
 * @property \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection|Category[]                                           $siblings                   The parent's other children.
 * @property int|null                                                                                                   $siblings_count
 * @property \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection|Category[]                                           $siblingsAndSelf            All the parent's children.
 * @property int|null                                                                                                   $siblings_and_self_count
 *
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static>  all($columns = ['*'])
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|Category breadthFirst()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|Category depthFirst()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|Category doesntHaveChildren()
 * @method static \Modules\Predict\Database\Factories\CategoryFactory                 factory($count = null, $state = [])
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static>  get($columns = ['*'])
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|Category getExpressionGrammar()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|Category hasChildren()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|Category hasParent()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|Category isLeaf()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|Category isRoot()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|Category newModelQuery()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category              onlyTrashed()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|Category query()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|Category tree($maxDepth = null)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|Category treeOf(\Illuminate\Database\Eloquent\Model|callable $constraint, $maxDepth = null)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|Category whereCreatedAt($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|Category whereCreatedBy($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|Category whereDeletedAt($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|Category whereDeletedBy($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|Category whereDepth($operator, $value = null)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|Category whereDescription($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|Category whereIcon($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|Category whereId($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|Category whereJsonContainsLocale(string $column, string $locale, ?mixed $value, string $operand = '=')
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|Category whereJsonContainsLocales(string $column, array $locales, ?mixed $value, string $operand = '=')
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|Category whereLocale(string $column, string $locale)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|Category whereLocales(string $column, array $locales)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|Category whereParentId($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|Category whereSlug($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|Category whereTitle($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|Category whereUpdatedAt($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|Category whereUpdatedBy($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|Category withGlobalScopes(array $scopes)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|Category withRelationshipExpression($direction, callable $constraint, $initialDepth, $from = null, $maxDepth = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category              withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category              withoutTrashed()
 *
 * @mixin \Eloquent
 */
class Category extends BaseCategory
{
    /** @var string */
    protected $connection = 'predict'; // this will use the specified database connection
}
