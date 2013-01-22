<?php

class RikssymDocument extends BaseRikssymDocument
{
    public function getActiveJobsCriteria()
    {
      $criteria = new Criteria();
      return RikssymDocumentPeer::addActiveJobsCriteria($criteria);
    }

    public function getActiveJobs($max = 10)
    {
      $criteria = new Criteria();
      $criteria->setLimit($max);
      return RikssymDocumentPeer::doSelect($criteria);
    }

    public function countActiveJobs()
    {
      $criteria = new Criteria();
      return RikssymDocumentPeer::doCount($criteria);
    }

}
