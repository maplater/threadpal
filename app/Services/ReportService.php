<?php

namespace App\Services;


use Illuminate\Support\Facades\Auth;


use App\Services\ReachService;
use App\Repositories\ChartRepository;
use App\Services\TokenService;
use App\Repositories\ReportRepository;
use App\Services\SlugService;
use App\Services\KeywordService;



class ReportService{


    protected $reportType3 = array(
        'main'=> array('Chart_Entertainment_Profiles','Chart_Fitness_Profiles','Chart_Food_Profiles','Chart_Sports_Profiles'),
    );
    protected $reportType = array(
        'main'=> array('Chart_Gender','Chart_Age','Chart_Income','Chart_Ethnicity','Chart_Education','Chart_Relationship','Chart_Sexuality','Chart_Home_Ownership','Chart_Parents','Chart_Politics','Chart_Mobile_OS','Chart_Buyer_Profiles','Chart_Store_Type','Chart_Travel_Profiles','Chart_Entertainment_Profiles','Chart_Fitness_Profiles','Chart_Food_Profiles','Chart_Sports_Profiles'),
    );

    protected $reportType2 = array(
        'main'=> array('Chart_Gender','Chart_Age','Chart_Income','Chart_Ethnicity','Chart_Education','Chart_Relationship','Chart_US_Geo'),
    );


    protected $reachService;
    protected $chartRepository;
    protected $tokenService;
    protected $reportRepository;
    protected $slugService;
    protected $keywordService;


    public function __construct(KeywordService $keywordService,SlugService $slugService,ReachService $reachService, ChartRepository $chartRepository, TokenService $tokenService, ReportRepository $reportRepository)
    {
        $this->slugService = $slugService;
        $this->reachService = $reachService;
        $this->chartRepository = $chartRepository;
        $this->tokenService = $tokenService;
        $this->reportRepository = $reportRepository;
        $this->keywordService = $keywordService;
    }

    public function create($keywordName = NULL, $keywordId = NULL, $type = 'main')
    {

        if($keywordId == NULL && $keywordName == NULL)
        {
            $name = 'master';

            $report = $this->getMasterReport($type);

        }elseif($keywordName == NULL && $keywordId != NULL){

            $keywordName = $this->keywordService->getKeywordNamebyId($keywordId);

            $name = $keywordName;

            $report = $this->checkReportExistence($keywordId);

        }else{
            $name = $keywordName;

            $report = $this->checkReportExistence($keywordId);
        }



        //for each chart get targeting specs from reachservice
        //Every 50 targeting specs get reach
        //Sort reachs into $data[$chart] scheme


        /*$targeting_array = array();

        foreach($this->reportType[$type] as $chart)
        {

            $targeting = $this->reachService->$chart($keywordName, $keywordId);

            $targeting_array = array_merge($targeting_array, $targeting);

        }*/

        foreach ($this->reportType[$type] as $chart)
        {
            $tokenCollection = $this->tokenService->getRandomToken('facebook');

            $data[$chart] = $this->chartRepository->$chart($tokenCollection, $keywordName, $keywordId);
            sleep(60);
        }


        //check if keywords exist in database
        //if no, create slug and store
        //if yes, update





        if(isset($report)){

            $finalReport = $this->update($report->id, $data, $keywordId, $name);

        }else {

            $slug = str_slug($name);

            $finalReport = $this->store($data, $keywordId, $name, $slug);


        }

        return $finalReport;

    }

    public function store($data, $keywordId, $name, $slug, $type = 'main')
    {
        return $this->reportRepository->store($data, $keywordId, $name, $slug, $type);
    }

    public function show($id)
    {
        //get report
        //get report type
        //loop through charts for report type and get data for that report
        //get master report charts for report type
        //do indexing math

        $report = $this->getReport($id);

        $masterReport = $this->getMasterReport($report->type);

        foreach ($this->reportType[$report->type] as $chart)
        {
            $tempCollection = $this->chartRepository->getChartData($report->id,$chart);

            unset($tempCollection->id);
            unset($tempCollection->report_id);
            unset($tempCollection->created_at);
            unset($tempCollection->updated_at);

            $reportData[$chart] = $tempCollection;
        }

        foreach ($this->reportType[$report->type] as $chart)
        {
            $tempCollection = $this->chartRepository->getChartData($masterReport->id,$chart);

            unset($tempCollection->id);
            unset($tempCollection->report_id);
            unset($tempCollection->created_at);
            unset($tempCollection->updated_at);

            $masterReportData[$chart] = $tempCollection;
        }

        foreach ($reportData as $chart => $data)
        {
            $chartTotal = $data->total;
            $masterTotal = $masterReportData[$chart]->total;

            foreach($data as $trait => $value)
            {
                if($trait != 'total')
                {
                    $chartPercent = $value / $chartTotal;

                    $masterPercent = $masterReportData[$chart]->$trait / $masterTotal;

                    $index = ($chartPercent - $masterPercent)/$masterPercent *100;

                    $calculatedData[$chart]['percent'][$trait] = round($chartPercent,10);
                    $calculatedData[$chart]['index'][$trait] = round($index);
                }
            }

        }

        return $calculatedData;


    }

    public function update($id, $data, $keywordId, $name)
    {
        return $this->reportRepository->update($id,$data, $keywordId, $name);
    }

    public function checkReportExistence($keywordId)
    {
        return $this->reportRepository->checkReportExistence($keywordId);
    }

    public function getMasterReport($type)
    {
        return $this->reportRepository->getMasterReport($type);
    }

    public function getReport($id)
    {
        return $this->reportRepository->getReport($id);
    }
}