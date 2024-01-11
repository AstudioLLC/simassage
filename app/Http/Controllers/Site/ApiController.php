<?php

namespace App\Http\Controllers\Site;

use App\Constants\UserRole;
use App\Models\Children;
use App\Models\Country;
use App\Models\Donation;
use App\Models\Fundraiser;
use App\Models\User;
use App\Models\UserOptions;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ApiController extends BaseController
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSponsorsInformation()
    {
        abort_if(!$this->CheckAuthorization(), 404);
        $array = $this->getSponsors();
        return response()
            ->json($array, 200, [], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getChildrensInformation()
    {
        abort_if(!$this->CheckAuthorization(), 404);
        $array = $this->getChildrens();
        return response()
            ->json($array, 200, [], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getFundraisersInformation()
    {
        abort_if(!$this->CheckAuthorization(), 404);
        $array = $this->getFundraisers();
        return response()
            ->json($array, 200, [], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
    }

    private function CheckAuthorization()
    {
        if (isset($_SERVER['HTTP_AUTH']) && isset($_SERVER['HTTP_PASSWORD'])) {
            if ($_SERVER['HTTP_AUTH'] == 'crm@donate.am' && $_SERVER['HTTP_PASSWORD'] == '7K0q5Q3e') {
                return true;
            }
        }

        return false;
    }

    /**
     * @return array
     */
    private function getSponsors()
    {
        $information = [];
        $sponsorIds = User::where(['role' => UserRole::SPONSOR, 'active' => 1])->select('id')->pluck('id')->toArray();
        if (count($sponsorIds)) {
            foreach ($sponsorIds as $id) {
                $infoArray = [
                    'Donor ID' => $this->getSponsorId($id),
                    //'Donor ID' => $id,
                    'Donor name' => $this->getSponsorName($id),
                    'Donation amount' => $this->getSponsorDonationAmounts($id),
                    'Donation date' => $this->getSponsorDonationDates($id),
                    //'Donation type' => $this->getSponsorDonationTypes($id),
                    'Donation type' => $this->getSponsorDonationBinding($id),
                    'Program name' => $this->getSponsorDonationFundraisersTitles($id),
                    'Last donation date' => $this->getSponsorLastDonationDate($id),
                    'Last donation amount' => $this->getSponsorLastDonationAmount($id),
                    'Total number of donations' => $this->getSponsorTotalDonationsCount($id),
                    'Annual donation amount' => $this->getSponsorAnnualDonationsAmountByYear($id),
                    'Average amount of donations' => $this->getSponsorTotalDonationsAverageAmount($id),
                    'Total income' => $this->getSponsorTotalDonationsSum($id),
                    'First name' => $this->getSponsorName($id),
                    'Donor type' => $this->getSponsorType($id),
                    //'Company name' => 'Some Company/empty',
                    'Age' => $this->getSponsorAge($id),
                    'Living place' => $this->getSponsorCountry($id),
                    'Date of becoming donor' => $this->getSponsorRegistrationDate($id),
                    'Field of activity' => $this->getSponsorLastActivityDate($id),
                    'Phone number' => $this->getSponsorPhone($id),
                    'Contact person' => $this->getSponsorName($id),
                    'Contact person phone number' => $this->getSponsorPhone($id),
                    'Child ID' => $this->getSponsorChildrenIds($id),
                    'Name' => $this->getSponsorChildrenNames($id),
                    'Date of birth' => $this->getSponsorChildrenDatesOfBirth($id),
                    'Gender' => $this->getSponsorChildrenGender($id),
                    'needs' => $this->getSponsorChildrenNeeds($id),
                ];
                array_push($information, $infoArray);
            }
        }

        return $information;
    }

    /**
     * @return array
     */
    private function getChildrens()
    {
        $information = [];
        $childrenIds = Children::sort()->select('id')->pluck('id')->toArray();
        if (count($childrenIds)) {
            foreach ($childrenIds as $id) {
                $infoArray = [
                    'Child ID' => $this->getChildrenChildId($id),
                    'Name' => $this->getChildrenName($id),
                    'Date of birth' => $this->getChildrenDateOfBirth($id),
                    'Gender' => $this->getChildrenGender($id),
                    'Needs' => $this->getChildrenNeeds($id),
                ];
                array_push($information, $infoArray);
            }
        }
        return $information;
    }

    /**
     * @return array
     */
    private function getFundraisers()
    {
        $information = [];
        $fundraiserIds = Fundraiser::withTrashed()->sort()->select('id')->pluck('id')->toArray();
        if (count($fundraiserIds)) {
            foreach ($fundraiserIds as $id) {
                $infoArray = [
                    'Project name' => $this->getFundraiserTitle($id),
                    'Project start date' => $this->getFundraiserStartDate($id),
                    'Project end date' => $this->getFundraiserEndDate($id),
                    'Target amount' => $this->getFundraiserTargetAmount($id),
                    'Total income' => $this->getFundraiserTotalIncome($id),
                ];
                array_push($information, $infoArray);
            }
        }
        return $information;
    }

    /**
     * @param int $id
     * @return string
     */
    private function getSponsorId(int $id)
    {
        $sponsorIdResponce = '';
        $sponsorId = UserOptions::where('user_id', $id)->select('sponsor_id')->first();
        if ($sponsorId && $sponsorId->sponsor_id) {
            $sponsorIdResponce = $sponsorId->sponsor_id;
        }

        return $sponsorIdResponce;
    }

    /**
     * @param int $id
     * @return mixed
     */
    private function getSponsorName(int $id)
    {
        $item = User::where('id', $id)->select('name')->first();

        return $item->name;
    }

    /**
     * @param int $id
     * @return int|string|null
     */
    private function getSponsorAge(int $id)
    {
        $sponsorAge = '';
        $sponsorDateOfBirth = UserOptions::where('user_id', $id)->select('date_of_birth')->first();
        if ($sponsorDateOfBirth && $sponsorDateOfBirth->date_of_birth) {
            $sponsorAge = Carbon::parse($sponsorDateOfBirth->date_of_birth)->age ?? null;
        }

        return $sponsorAge;
    }

    /**
     * @param int $id
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Translation\Translator|string|null
     */
    private function getSponsorType(int $id)
    {
        $sponsorTypeResponce = __('app.Not corporate');
        $sponsorType = UserOptions::where('user_id', $id)->select('donor_type')->first();
        if ($sponsorType && $sponsorType->donor_type) {
            $sponsorTypeResponce = __('app.Corporate');
        }

        return $sponsorTypeResponce;
    }

    /**
     * @param int $id
     * @return string
     */
    private function getSponsorCountry(int $id)
    {
        $item = User::where('id', $id)->first()->options;
        $countryName = '';
        if (isset($item) && $item->country_id) {
            $country = Country::where('id', $item->country_id)->first();
            if ($country) {
                $countryName = $country->title;
            }
        }

        return $countryName;
    }

    /**
     * @param int $id
     * @return array
     */
    private function getSponsorDonationAmounts(int $id)
    {
        $sponsorDonationAmounts = Donation::withTrashed()
            ->where(['sponsor_id' => $id, 'status' => 1])
            ->orderBy('created_at', 'asc')
            ->select('amount')
            ->pluck('amount')
            ->toArray();

        return $sponsorDonationAmounts;
    }

    /**
     * @param int $id
     * @return array
     */
    private function getSponsorDonationDates(int $id)
    {
        $sponsorDonationDates = Donation::withTrashed()
            ->where(['sponsor_id' => $id, 'status' => 1])
            ->orderBy('created_at', 'asc')
            ->select(DB::raw('DATE_FORMAT(created_at, "%d/%m/%Y") as formatted_dob'))
            ->pluck('formatted_dob')
            ->toArray();

        return $sponsorDonationDates;
    }




    /**
     * @param int $id
     * @return array
     */
    private function getSponsorDonationBinding(int $id)
    {
        $sponsorDonationBindingsArray = [];
        $sponsorDonationBindings = Donation::withTrashed()
            ->where(['sponsor_id' => $id, 'status' => 1])
            ->orderBy('created_at', 'asc')
            ->select('is_binding')
            ->get()
            ->toArray();
        foreach ($sponsorDonationBindings as $row => $sponsorDonationBinding) {
            if ($sponsorDonationBinding['is_binding'] == 0) {
                array_push($sponsorDonationBindingsArray, __('app.Not binded'));
            } else {
                array_push($sponsorDonationBindingsArray, __('app.Binded'));
            }
        }

        return $sponsorDonationBindingsArray;
    }

    /**
     * @param int $id
     * @return string
     */
    private function getSponsorLastDonationDate(int $id)
    {
        $sponsorLastDonationDate = '';
        $item = Donation::withTrashed()
            ->where(['sponsor_id' => $id, 'status' => 1])
            ->select('created_at')
            ->orderBy('created_at', 'desc')
            ->first();
        if (isset($item) && $item->created_at) {
            $sponsorLastDonationDate = $item->created_at->format('d/m/Y');
        }

        return $sponsorLastDonationDate;
    }

    /**
     * @param int $id
     * @return array|int
     */
    private function getSponsorAnnualDonationsAmountByYear(int $id)
    {
        $sponsorAnnualDonationsAmountByYear = 0;
        $item = Donation::withTrashed()
            ->where(['sponsor_id' => $id, 'status' => 1])
            ->select([
                DB::raw('year(created_at) as year'),
                DB::raw('sum(amount) as amount')
            ])
            ->groupBy('year')
            ->get()
            ->toArray();
        if (isset($item)) {
            $sponsorAnnualDonationsAmountByYear = $item;
        }

        return $sponsorAnnualDonationsAmountByYear;
    }

    /**
     * @param int $id
     * @return int
     */
    private function getSponsorTotalDonationsCount(int $id)
    {
        $sponsorTotalDonationsCount = 0;
        $item = Donation::withTrashed()->where(['sponsor_id' => $id, 'status' => 1])->select('id')->count();
        if (isset($item)) {
            $sponsorTotalDonationsCount = $item;
        }

        return $sponsorTotalDonationsCount;
    }

    /**
     * @param int $id
     * @return float|int
     */
    private function getSponsorTotalDonationsAverageAmount(int $id)
    {
        $sponsorTotalDonationsAverageAmount = 0;
        if ($this->getSponsorTotalDonationsSum($id) && $this->getSponsorTotalDonationsCount($id)) {
            $sponsorTotalDonationsAverageAmount = ceil($this->getSponsorTotalDonationsSum($id) / $this->getSponsorTotalDonationsCount($id));
        }
        return $sponsorTotalDonationsAverageAmount;
    }

    /**
     * @param int $id
     * @return int|mixed
     */
    private function getSponsorTotalDonationsSum(int $id)
    {
        $sponsorTotalDonationsSum = 0;
        $item = Donation::withTrashed()->where(['sponsor_id' => $id, 'status' => 1])->select('amount')->sum('amount');
        if (isset($item)) {
            $sponsorTotalDonationsSum = $item;
        }

        return $sponsorTotalDonationsSum;
    }

    /**
     * @param int $id
     * @return string
     */
    private function getSponsorLastDonationAmount(int $id)
    {
        $sponsorLastDonationAmount = '';
        $item = Donation::withTrashed()
            ->where(['sponsor_id' => $id, 'status' => 1])
            ->orderBy('created_at', 'desc')
            ->select('amount')
            ->first();
        if (isset($item) && $item->amount) {
            $sponsorLastDonationAmount = $item->amount;
        }

        return $sponsorLastDonationAmount;
    }

    /**
     * @param int $id
     * @return mixed
     */
    private function getSponsorRegistrationDate(int $id)
    {
        $item = User::where('id', $id)->select('created_at')->first();

        return $item->created_at->format('d/m/Y');
    }

    /**
     * @param int $id
     * @return string
     */
    private function getSponsorLastActivityDate(int $id)
    {
        $item = User::where('id', $id)->select('last_activity_at')->first();
        if ($item->last_activity_at) {
            return $item->last_activity_at->format('d/m/Y');
        }
        return '';
    }

    /**
     * @param int $id
     * @return string
     */
    private function getSponsorPhone(int $id)
    {
        $item = User::where('id', $id)->select('phone')->first();
        if ($item->phone) {
            return $item->phone;
        }

        return '';
    }

    /**
     * @param int $id
     * @return mixed
     */
    private function getSponsorChildrenIds(int $id)
    {
        $childrenIds = Children::where('sponsor_id', $id)->select('child_id')->pluck('child_id')->toArray();

        return $childrenIds;
    }

    /**
     * @param int $id
     * @return mixed
     */
    private function getSponsorChildrenNames(int $id)
    {
        $childrenNames = Children::where('sponsor_id', $id)->select('title')->pluck('title')->toArray();

        return $childrenNames;
    }

    /**
     * @param int $id
     * @return mixed
     */
    private function getSponsorChildrenDatesOfBirth(int $id)
    {
        $childrenDatesOfBirth = Children::where('sponsor_id', $id)->select('date_of_birth')->pluck('date_of_birth')->toArray();

        return $childrenDatesOfBirth;
    }

    /**
     * @param int $id
     * @return mixed
     */
    private function getSponsorChildrenGender(int $id)
    {
        $childrenGender = Children::where('sponsor_id', $id)->select('gender')->pluck('gender')->toArray();
        foreach ($childrenGender as $key => $item) {
            if (!$item) {
                $childrenGender[$key] = 'Not selected';
            } else {
                if ($item == 0) {
                    $childrenGender[$key] = 'Male';
                } else {
                    $childrenGender[$key] = 'Female';
                }
            }
        }

        return $childrenGender;
    }

    /**
     * @param int $id
     * @return array
     */
    private function getSponsorChildrenNeeds(int $id)
    {
        $childrenNeeds = Children::where('sponsor_id', $id)->select('id', 'title')->with('needs:title')->get();
        $childrensWithNeeds = [];
        if ($childrenNeeds) {
            foreach ($childrenNeeds as $children) {
                if (count($children->needs)) {
                    $childrensWithNeeds[$children->title] = [];
                    foreach ($children->needs as $need) {
                        array_push($childrensWithNeeds[$children->title], $need->title);
                    }
                }
            }
        }

        return $childrensWithNeeds;
    }

    /**
     * @param int $id
     * @return string
     */
    private function getChildrenChildId(int $id)
    {
        $childrenId = Children::where('id', $id)->select('child_id')->first();
        if ($childrenId->child_id) {
            return $childrenId->child_id;
        }

        return '';
    }

    /**
     * @param int $id
     * @return string
     */
    private function getChildrenName(int $id)
    {
        $childrenName = Children::where('id', $id)->select('title')->first();
        if ($childrenName->title) {
            return $childrenName->title;
        }

        return '';

    }

    /**
     * @param int $id
     * @return string
     */
    private function getChildrenDateOfBirth(int $id)
    {
        $childrenDateOfBirth = Children::where('id', $id)->select('date_of_birth')->first();
        if ($childrenDateOfBirth->date_of_birth) {
            return $childrenDateOfBirth->date_of_birth;
        }

        return '';
    }

    /**
     * @param int $id
     * @return string
     */
    private function getChildrenGender(int $id)
    {
        $childrenGender = Children::where('id', $id)->select('gender')->first();

        if (!is_null($childrenGender->gender)) {
            if ($childrenGender->gender == 0) {
                $gender = 'Male';
            } else {
                $gender = 'Female';
            }
        } else {
            $gender = 'Not selected';
        }

        return $gender;
    }

    /**
     * @param int $id
     * @return array
     */
    private function getChildrenNeeds(int $id)
    {
        $childrenWithNeeds = Children::where('id', $id)->select('id', 'title')->with('needs:title')->first();
        $needs = [];
        if (count($childrenWithNeeds->needs)) {
            foreach ($childrenWithNeeds->needs as $need) {
                array_push($needs, $need->title);
            }
        }

        return $needs;
    }

    /**
     * @param int $id
     * @return string
     */
    private function getFundraiserTitle(int $id)
    {
        $fundraiserTitle = Fundraiser::withTrashed()->where('id', $id)->select('title')->first();
        if ($fundraiserTitle->title) {
            return htmlspecialchars($fundraiserTitle->title);
        }

        return '';
    }

    /**
     * @param int $id
     * @return string
     */
    private function getFundraiserStartDate(int $id)
    {
        $fundraiserStartDate = Fundraiser::withTrashed()->where('id', $id)->select('start_date')->first();
        if ($fundraiserStartDate->start_date) {
            return $fundraiserStartDate->start_date->format('d/m/Y');
        }

        return '';
    }

    /**
     * @param int $id
     * @return string
     */
    private function getFundraiserEndDate(int $id)
    {
        $fundraiserEndDate = Fundraiser::withTrashed()->where('id', $id)->select('end_date')->first();
        if ($fundraiserEndDate->end_date) {
            return $fundraiserEndDate->end_date->format('d/m/Y');
        }

        return '';
    }

    /**
     * @param int $id
     * @return float|string
     */
    private function getFundraiserTargetAmount(int $id)
    {
        $fundraiserTargetAmount = Fundraiser::withTrashed()->where('id', $id)->select('cost')->first();
        if ($fundraiserTargetAmount->cost) {
            return ceil($fundraiserTargetAmount->cost);
        }

        return '';
    }

    /**
     * @param int $id
     * @return float|string
     */
    private function getFundraiserTotalIncome(int $id)
    {
        $fundraiserTotalIncome = Fundraiser::withTrashed()->where('id', $id)->select('collected')->first();
        if ($fundraiserTotalIncome->collected) {
            return ceil($fundraiserTotalIncome->collected);
        }

        return '';
    }
}
