<?php
/**
 * Concord CRM - https://www.concordcrm.com
 *
 * @version   1.5.1
 *
 * @link      Releases - https://www.concordcrm.com/releases
 * @link      Terms Of Service - https://www.concordcrm.com/terms
 *
 * @copyright Copyright (c) 2022-2024 KONKORD DIGITAL
 */

namespace Modules\Core\Filters;

use Illuminate\Database\Eloquent\Builder;

class HasFilter extends OperandFilter
{
    /**
     * Apply the filter to the given query.
     */
    public function apply(Builder $query, string $condition, QueryBuilder $builder): Builder
    {
        if ($this->getOperandInstance()->getFilter() instanceof RelationCountBasedFilter) {
            return $builder->applyCountRelationshipQuery(
                $query,
                $this->getOperandInstance()->getFilter(),
                $condition,
                function (Builder $query) {
                    $this->applyViewAuthorizedCriteriaIfNeeded($query);
                }
            );
        }

        return $query->has($this->field(), '>=', 1, $condition, function (Builder $query) use ($builder) {
            $this->applyViewAuthorizedCriteriaIfNeeded($query);

            // Use AND for the subquery of the relation rules
            return $builder->applyQuery($query, $this->getOperandInstance()->getFilter(), 'AND');
        });
    }

    /**
     * Apply view authorized criteria to the builder if the builder model is associated with resources
     */
    protected function applyViewAuthorizedCriteriaIfNeeded(Builder $query): Builder
    {
        if (
            method_exists($query->getModel(), 'resource') &&
            $criteria = $query->getModel()->resource()->viewAuthorizedRecordsCriteria()
        ) {
            (new $criteria)->apply($query);
        }

        return $query;
    }
}
